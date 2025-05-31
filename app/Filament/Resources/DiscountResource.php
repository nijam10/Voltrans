<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiscountResource\Pages;
use App\Filament\Resources\DiscountResource\RelationManagers;
use App\Models\Discount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';

    protected static ?string $activeNavigationIcon = 'heroicon-s-percent-badge';

    protected static ?string $navigationLabel = 'Diskon';

    protected static ?string $breadcrumb = 'Diskon';

    protected static ?string $label = 'List Diskon';

    protected static ?string $navigationGroup = 'Operasional';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Diskon')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Nama Diskon')
                            ->placeholder('Masukkan Nama Diskon')
                            ->maxLength(255),
                        TextInput::make('code')
                            ->required()
                            ->label('Kode Diskon')
                            ->placeholder('Masukkan Kode Diskon')
                            ->maxLength(50),
                        Select::make('discount_type')
                            ->options([
                                'percentage' => 'Persentase',
                                'nominal' => 'Nominal',
                            ])
                            ->required()
                            ->label('Jenis Diskon')
                            ->placeholder('Pilih Jenis Diskon'),
                        TextInput::make('value')
                            ->required()
                            ->label('Nilai Diskon')
                            ->placeholder('Masukkan Nilai Diskon')
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\DatePicker::make('valid_from')
                            ->required()
                            ->label('Berlaku Mulai')
                            ->placeholder('Pilih Tanggal Mulai'),
                        Forms\Components\DatePicker::make('valid_until')
                            ->required()
                            ->label('Berlaku Hingga')
                            ->placeholder('Pilih Tanggal Berakhir'),
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->label('Status Aktif')
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Diskon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Diskon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_type')
                    ->label('Jenis Diskon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai Diskon')
                    ->numeric(),
                Tables\Columns\TextColumn::make('valid_from')
                    ->label('Berlaku Mulai')
                    ->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('valid_until')
                    ->label('Berlaku Hingga')
                    ->dateTime('d/m/Y H:i'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
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
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }
}
