<?php

namespace App\Filament\Resources\ApprovalResource\Pages;

use App\Filament\Resources\ApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApproval extends CreateRecord
{
    protected static string $resource = ApprovalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Assign the current user as the approver
        $data['approver_id'] = auth()->id();

        return $data;
    }
}
