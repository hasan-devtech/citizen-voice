<?php

namespace App\Filament\Resources\ComplainantResource\Pages;

use App\Filament\Resources\ComplainantResource;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ManageRecords;

class ManageComplainants extends ManageRecords
{
    protected static string $resource = ComplainantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false)
                ->slideOver()
                ->modalWidth(MaxWidth::ThreeExtraLarge)
                ->mutateFormDataUsing(function (array $data) {
                    $data['is_verified'] = true;
                    return $data;
                }),

        ];
    }
}
