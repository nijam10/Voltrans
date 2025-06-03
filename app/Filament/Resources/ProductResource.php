<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Notifications\Notification;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $activeNavigationIcon = 'heroicon-s-truck';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $breadcrumb = 'Produk';

    protected static ?string $label = 'List Produk';

    protected static ?string $slug = 'products';

    protected static ?string $navigationGroup = 'Manajemen Produk';


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
                        ->placeholder('Masukkan Nama Produk')
                        ->maxLength(255),
                    TextInput::make('price')
                        ->required()
                        ->label('Harga')
                        ->placeholder('Masukkan Harga Produk')
                        ->numeric()
                        ->prefix('Rp')
                        ->minValue(0)
                        ->maxValue(1000000),
                    TextInput::make('battery_capacity')
                        ->required()
                        ->label('Kapasitas Baterai')
                        ->prefix('kWh')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(2000)
                        ->placeholder('Masukkan Kapasitas Baterai Produk'),
                    TextInput::make('power')
                        ->required()
                        ->label('Tenaga')
                        ->placeholder('Masukkan Tenaga Kendaraan')
                        ->prefix('hp')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(2000),
                    RichEditor::make('description')
                        ->required()
                        ->label('Deskripsi Kendaraan')
                        ->placeholder('Tambahkan Deskripsi Kendaraan')
                        ->columnSpan('1/2')
                        ->disableToolbarButtons([
                            'codeBlock',
                            'h1',
                            'h2',
                            'h3',
                            'quote',
                    ])
                    ->maxLength(65535),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->label('Jenis Kendaraan')
                        ->placeholder('Pilih Jenis Kendaraan'),
                    FileUpload::make('thumbnail')
                        ->required()
                        ->label('Gambar Kendaraan')
                        ->imagePreviewHeight('250')
                        ->loadingIndicatorPosition('left')
                        ->panelAspectRatio('2:1')
                        ->panelLayout('integrated')
                        ->removeUploadedFileButtonPosition('right')
                        ->uploadButtonPosition('left')
                        ->uploadProgressIndicatorPosition('left')
                        ->columnSpan('1/2')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->directory('products')
                        ->visibility('public')
                        ->enableOpen(),
                    Forms\Components\Repeater::make('images')
                        ->simple(
                                FileUpload::make('image')
                                ->required()
                                ->image()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->directory('products')
                                ->visibility('public')
                                ->enableOpen()
                                ->loadingIndicatorPosition('left')
                                ->panelAspectRatio('16:9')
                                ->panelLayout('integrated')
                                ->removeUploadedFileButtonPosition('right')
                                ->uploadButtonPosition('right')
                                ->uploadProgressIndicatorPosition('right'),
                            )
                        ->relationship('images')
                        ->label('Gambar Tambahan')
                        ->itemLabel(function (array $state, $component): ?string {
                                    if (!$state['image']) {
                                        return null;
                                    }
                                    $key = array_search($state, $component->getState());
                                    $index = array_search($key, array_keys($component->getState()));
                                    return $index + 1;
                                })
                        ->defaultItems(1)
                        ->addActionLabel('Tambah Gambar')
                        ->grid(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->size(100),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('battery_capacity')
                    ->label('Kapasitas Baterai')
                    ->suffix(' kWh'),
                Tables\Columns\TextColumn::make('power')
                    ->label('Tenaga')
                    ->suffix(' hp'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Ditambah')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Jenis Kendaraan')
                    ->relationship('category', 'name')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()

                    ->action(function (Model $record) {
                        try {
                        Storage::disk('public')->delete($record->image);
                        $record->delete();
                            Notification::make()
                                ->title('Data Berhasil Dihapus')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body('Terjadi error saat menghapus produk')
                                ->danger()
                                ->send();
                        }
                    }),
                    
                    
                ])
                ->button()
                ->label('Aksi'),
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
