<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Item Pesanan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->required()
                            ->disabled(fn (string $context): bool => $context === 'edit'),
                        
                        TextInput::make('price')
                            ->label('Harga per Hari')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->disabled(fn (string $context): bool => $context === 'edit'),
                        
                        DatePicker::make('started_at')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->disabled(fn (string $context): bool => $context === 'edit'),
                        
                        DatePicker::make('ended_at')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->disabled(fn (string $context): bool => $context === 'edit'),
                        
                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->disabled(fn (string $context): bool => $context === 'edit'),
                        
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'dalam_proses' => 'Dalam Proses',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'dibatalkan') {
                                    $set('cancellation_reason', '');
                                }
                            }),
                    ]),
                
                Textarea::make('cancellation_reason')
                    ->label('Alasan Pembatalan')
                    ->rows(3)
                    ->visible(fn (callable $get): bool => $get('status') === 'dibatalkan')
                    ->required(fn (callable $get): bool => $get('status') === 'dibatalkan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                ImageColumn::make('product.thumbnail')
                    ->label('Produk')
                    ->circular()
                    ->size(40),
                
                TextColumn::make('product.name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                
                TextColumn::make('rental_period')
                    ->label('Periode Rental')
                    ->getStateUsing(function ($record): string {
                        return $record->started_at->format('d M Y') . ' - ' . $record->ended_at->format('d M Y');
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('started_at', $direction);
                    }),
                
                TextColumn::make('rental_duration')
                    ->label('Durasi')
                    ->getStateUsing(function ($record): string {
                        return $record->rental_duration . ' hari';
                    })
                    ->sortable(),
                
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'dalam_proses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dalam_proses' => 'Dalam Proses',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                        default => $state,
                    })
                    ->sortable(),
                
                TextColumn::make('price')
                    ->label('Harga/Hari')
                    ->money('IDR')
                    ->sortable(),
                
                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dalam_proses' => 'Dalam Proses',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Item')
                    ->modalHeading('Tambah Item Pesanan')
                    ->modalDescription('Tambahkan item baru ke pesanan ini.')
                    ->modalSubmitActionLabel('Tambah Item')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit Item')
                    ->modalHeading('Edit Item Pesanan')
                    ->modalDescription('Edit informasi item pesanan.')
                    ->modalSubmitActionLabel('Simpan Perubahan')
                    ->modalCancelActionLabel('Batal'),
                
                Action::make('mark_completed')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->status === 'dalam_proses')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Item Selesai')
                    ->modalDescription('Apakah Anda yakin ingin menandai item ini sebagai selesai? Kendaraan telah dikembalikan dan diperiksa.')
                    ->modalSubmitActionLabel('Ya, Tandai Selesai')
                    ->modalCancelActionLabel('Batal')
                    ->action(function ($record) {
                        $record->update(['status' => 'selesai']);
                        
                        Notification::make()
                            ->title('Item berhasil ditandai selesai')
                            ->body('Kendaraan telah dikembalikan dan diperiksa.')
                            ->success()
                            ->send();
                    }),
                
                Action::make('mark_cancelled')
                    ->label('Tandai Dibatalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record): bool => $record->status === 'dalam_proses')
                    ->form([
                        Textarea::make('cancellation_reason')
                            ->label('Alasan Pembatalan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alasan pembatalan item...'),
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Item Dibatalkan')
                    ->modalDescription('Apakah Anda yakin ingin menandai item ini sebagai dibatalkan?')
                    ->modalSubmitActionLabel('Ya, Tandai Dibatalkan')
                    ->modalCancelActionLabel('Batal')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'dibatalkan',
                            'cancellation_reason' => $data['cancellation_reason'],
                        ]);
                        
                        Notification::make()
                            ->title('Item berhasil ditandai dibatalkan')
                            ->body('Item telah dibatalkan dengan alasan yang diberikan.')
                            ->success()
                            ->send();
                    }),
                
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus Item')
                    ->modalHeading('Hapus Item Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Action::make('bulk_complete')
                        ->label('Tandai Selesai Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Tandai Item Selesai Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menandai semua item terpilih sebagai selesai?')
                        ->modalSubmitActionLabel('Ya, Tandai Selesai')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->status === 'dalam_proses') {
                                    $record->update(['status' => 'selesai']);
                                    $count++;
                                }
                            }
                            
                            Notification::make()
                                ->title("{$count} item berhasil ditandai selesai")
                                ->success()
                                ->send();
                        }),
                    
                    Action::make('bulk_cancel')
                        ->label('Tandai Dibatalkan Terpilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->form([
                            Textarea::make('cancellation_reason')
                                ->label('Alasan Pembatalan')
                                ->required()
                                ->rows(3)
                                ->placeholder('Masukkan alasan pembatalan untuk semua item terpilih...'),
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Tandai Item Dibatalkan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menandai semua item terpilih sebagai dibatalkan?')
                        ->modalSubmitActionLabel('Ya, Tandai Dibatalkan')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($records, array $data) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->status === 'dalam_proses') {
                                    $record->update([
                                        'status' => 'dibatalkan',
                                        'cancellation_reason' => $data['cancellation_reason'],
                                    ]);
                                    $count++;
                                }
                            }
                            
                            Notification::make()
                                ->title("{$count} item berhasil ditandai dibatalkan")
                                ->success()
                                ->send();
                        }),
                    
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
