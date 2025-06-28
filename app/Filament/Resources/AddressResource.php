<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{TextInput, Textarea, Toggle, FileUpload, Select, Section};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn, IconColumn, BadgeColumn};
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Actions\Action;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $activeNavigationIcon = 'heroicon-s-map';

    protected static ?string $navigationLabel = 'Alamat';

    protected static ?string $label = 'Data Alamat';

    protected static ?string $breadcrumb = 'Alamat';

    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    public static function getModelLabel(): string
    {
        return 'Alamat Pengguna';
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Alamat')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->disabled(),
                        Textarea::make('address')
                            ->label('Detail Alamat')
                            ->disabled(),
                        TextInput::make('province')
                            ->label('Provinsi')
                            ->disabled(),
                        TextInput::make('city')
                            ->label('Kota')
                            ->disabled(),
                        TextInput::make('state')
                            ->label('Kecamatan')
                            ->disabled(),
                        TextInput::make('postal_code')
                            ->label('Kode Pos')
                            ->disabled(),
                    ])
                    ->columns(2),

                Section::make('Verifikasi KTP')
                    ->schema([
                        FileUpload::make('ktp_path')
                            ->label('Foto KTP')
                            ->disk('public')
                            ->directory('ktp')
                            ->image()
                            ->disabled()
                            ->visible(fn ($record) => !empty($record->ktp_path))
                            ->enableOpen(),
                    ])
                    ->visible(fn ($record) => !empty($record->ktp_path)),

                Section::make('Status Verifikasi')
                    ->schema([
                        Toggle::make('is_verified')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->label('Terverifikasi')
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    // If verified, clear rejection reason
                                    $set('rejection_reason', null);
                                }
                            }),
                        
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->hint('Wajib diisi jika alamat ditolak')
                            ->rows(3)
                            ->required(fn (Get $get) => !$get('is_verified'))
                            ->visible(fn (Get $get) => !$get('is_verified'))
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if (!empty($state)) {
                                    // If rejection reason is filled, uncheck verified
                                    $set('is_verified', false);
                                }
                            }),
                    ])
                    ->visible(fn ($record) => !empty($record->ktp_path)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Alamat')
                    ->searchable(),
                BadgeColumn::make('is_verified')
                    ->label('Status Verifikasi')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->isVerified()) {
                            return 'Terverifikasi';
                        }
                        if ($record->isRejected()) {
                            return 'Ditolak';
                        }
                        if ($record->isPendingVerification()) {
                            return 'Menunggu Verifikasi';
                        }
                        return 'Tidak Terverifikasi';
                    })
                    ->colors([
                        'success' => fn ($state, $record) => $record->isVerified(),
                        'danger' => fn ($state, $record) => $record->isRejected(),
                        'warning' => fn ($state, $record) => $record->isPendingVerification(),
                        'gray' => fn ($state, $record) => $record->isUnverified(),
                    ]),
                TextColumn::make('rejection_reason')
                    ->label('Alasan Penolakan')
                    ->limit(50)
                    ->visible(fn ($record) => $record && $record->isRejected()),
                TextColumn::make('created_at')
                    ->label('Waktu Pengajuan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('verification_status')
                    ->label('Status Verifikasi')
                    ->options([
                        'verified' => 'Terverifikasi',
                        'rejected' => 'Ditolak',
                        'pending' => 'Menunggu Verifikasi',
                        'unverified' => 'Tidak Terverifikasi',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value']) {
                            'verified' => $query->where('is_verified', true),
                            'rejected' => $query->where('is_verified', false)->whereNotNull('rejection_reason'),
                            'pending' => $query->where('is_verified', false)->whereNotNull('ktp_path')->whereNull('rejection_reason'),
                            'unverified' => $query->where('is_verified', false)->whereNull('ktp_path'),
                            default => $query,
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->color('primary'),
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record && $record->isPendingVerification())
                    ->action(function ($record) {
                        $record->update([
                            'is_verified' => true,
                            'rejection_reason' => null,
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Alamat')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui alamat ini?')
                    ->modalSubmitActionLabel('Ya, Setujui'),
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn ($record) => $record && $record->isPendingVerification())
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alasan penolakan...')
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'is_verified' => false,
                            'rejection_reason' => $data['rejection_reason'],
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Alamat')
                    ->modalDescription('Apakah Anda yakin ingin menolak alamat ini?')
                    ->modalSubmitActionLabel('Ya, Tolak'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddresses::route('/'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
