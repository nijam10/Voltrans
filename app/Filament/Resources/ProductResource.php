<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $breadcrumb = 'Produk';

    protected static ?string $label = 'Produk';

    protected static ?string $slug = 'produk';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Kendaraan')
                    ->placeholder('Masukkan Nama Kendaraan')
                    ->maxLength(255),
                TextInput::make('harga')
                    ->required()
                    ->label('Harga')
                    ->placeholder('Masukkan Harga Kendaraan')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(1000000),
                TextInput::make('jarak_tempuh')
                    ->required()
                    ->label('Jarak Tempuh')
                    ->placeholder('Masukkan Jarak Tempuh Kendaraan'),
                Select::make('jenis')
                    ->required()
                    ->label('Jenis Kendaraan')
                    ->placeholder('Pilih Jenis Kendaraan')
                    ->options([
                        'mobil' => 'Mobil',
                        'motor' => 'Motor',
                        'sepeda' => 'Sepeda',
                        'skuter' => 'Skuter',
                    ])
                    ->native(false),
                FileUpload::make('gambar')
                    ->required()
                    ->label('Gambar Kendaraan')
                    ->image()
                    ->preserveFilenames()
                    ->directory('images'),
                TextArea::make('deskripsi')
                    ->required()
                    ->rows(4)
                    ->cols(5)
                    ->label('Deskripsi')
                    ->placeholder('Masukkan Deskripsi Singkat Kendaraan')
                    ->maxLength(65535),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
