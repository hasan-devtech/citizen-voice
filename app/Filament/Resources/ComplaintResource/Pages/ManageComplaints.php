<?php

namespace App\Filament\Resources\ComplaintResource\Pages;

use App\Enums\ComplaintStatusEnum;
use App\Filament\Resources\ComplaintResource;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ManageRecords;

class ManageComplaints extends ManageRecords
{
    protected static string $resource = ComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false)
                ->slideOver()
                ->modalWidth(MaxWidth::ThreeExtraLarge)
                ->mutateFormDataUsing(function (array $data) {
                    $data['status'] = ComplaintStatusEnum::PENDING;
                    return $data;
                }),
        ];
    }
}
