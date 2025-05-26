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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $breadcrumb = 'Produk';

    protected static ?string $label = 'Produk';

    protected static ?string $slug = 'products';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Kendaraan')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->label('Nama Kendaraan')
                        ->placeholder('Masukkan Nama Kendaraan')
                        ->maxLength(255),
                    TextInput::make('price')
                        ->required()
                        ->label('Harga')
                        ->placeholder('Masukkan Harga Kendaraan')
                        ->numeric()
                        ->prefix('Rp')
                        ->minValue(0)
                        ->maxValue(1000000),
                    TextInput::make('mileage')
                        ->required()
                        ->label('Jarak Tempuh')
                        ->prefix('Km')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(1000)
                        ->placeholder('Masukkan Jarak Tempuh Kendaraan'),
                    Select::make('type')
                        ->required()
                        ->label('Jenis Kendaraan')
                        ->placeholder('Pilih Jenis Kendaraan')
                        ->options([
                            'mobil' => 'Mobil',
                            'motor' => 'Motor',
                            'sepeda' => 'Sepeda',
                            'skuter' => 'Skuter',
                        ])
                        ,
                    FileUpload::make('image')
                        ->required()
                        ->label('Gambar Kendaraan')
                        ->columnSpan('full')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->preserveFilenames()
                        ->directory('products')
                        ->visibility('public')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                ->prepend('product-'),
                        ),
                        
                    RichEditor::make('description')
                        ->required()
                        ->label('Deskripsi Kendaraan')
                        ->placeholder('Tambahkan Deskripsi Kendaraan')
                        ->columnSpan('full')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'h1',
                            'h2',
                            'h3',
                            'quote',
                        'codeBlock',
                    ])
                    ->maxLength(65535),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(100)
                    ->defaultImageUrl(url('images/user-placeholder.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('mileage')
                    ->label('Jarak Tempuh'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Ditambahkan')
                    ->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime('d/m/Y H:i'),
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
