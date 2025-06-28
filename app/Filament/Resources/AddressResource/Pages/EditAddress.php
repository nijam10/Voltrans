<?php

namespace App\Filament\Resources\AddressResource\Pages;

use App\Filament\Resources\AddressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAddress extends EditRecord
{
    protected static string $resource = AddressResource::class;

    protected static ?string $title = 'Verifikasi Alamat';

    public function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function authorizeAccess(): void
    {
        return;
    }
}
