<?php

namespace App\Domains\Reports\Filament\Resources\UserUsageResource\Pages;

use App\Domains\Reports\Filament\Resources\UserUsageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserUsages extends ListRecords
{
    protected static string $resource = UserUsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
