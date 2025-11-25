<?php

namespace App\Filament\Resources\ComplaintCategoryResource\Pages;

use App\Filament\Resources\ComplaintCategoryResource;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ManageRecords;

class ManageComplaintCategories extends ManageRecords
{
    protected static string $resource = ComplaintCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false)
                ->slideOver()
                ->modalWidth(MaxWidth::ThreeExtraLarge)
        ];
    }
}
