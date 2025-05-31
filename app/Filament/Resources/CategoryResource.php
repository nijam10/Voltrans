<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $activeNavigationIcon = 'heroicon-s-tag';

    protected static ?string $navigationLabel = 'Kategori';

    protected static ?string $breadcrumb = 'Kategori';

    protected static ?string $label = 'List Kategori';

    protected static ?string $navigationGroup = 'Manajemen Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Kategori')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nama')
                            ->placeholder('Masukkan Nama Kategori')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                        ->required()
                        ->label('Gambar')
                        ->columnSpan('1')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->directory('categories')
                        ->visibility('public'),
                        
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(100),
                    
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->limit(50),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
