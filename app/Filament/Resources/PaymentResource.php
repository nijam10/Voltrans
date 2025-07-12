<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $activeNavigationIcon = 'heroicon-s-banknotes';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?string $breadcrumb = 'Pembayaran';

    protected static ?string $label = 'Data Pembayaran';

    protected static ?string $navigationGroup = 'Operasional';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Order')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->label('Tipe Pembayaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gross_amount')
                    ->label('Total Pembayaran')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'danger' => 'expired',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Pembayaran')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('order_code')->label('Kode Order'),
                        TextEntry::make('payment_type')->label('Tipe Pembayaran'),
                        TextEntry::make('va_number')->label('VA Number'),
                        TextEntry::make('bank')->label('Bank'),
                        TextEntry::make('gross_amount')->label('Total Pembayaran')->money('IDR'),
                        TextEntry::make('payment_status')->label('Status'),
                        TextEntry::make('created_at')->label('Tanggal')->dateTime('d M Y H:i'),
                        TextEntry::make('paid_at')->label('Tanggal Dibayar')->dateTime('d M Y H:i'),
                    ]),
                Section::make('Detail Customer')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('order.customer.name')->label('Nama Pengguna'),
                        TextEntry::make('order.customer.email')->label('Email Pengguna'),
                        TextEntry::make('order.customer.phone')->label('No. Telepon Pengguna'),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'view' => Pages\ViewPayment::route('/{record}'),
        ];
    }
}
