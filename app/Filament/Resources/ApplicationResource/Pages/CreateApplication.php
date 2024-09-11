<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApplication extends CreateRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove commas from price-related fields
        $priceFields = ['vehicle_price', 'down_payment', 'monthly_installment'];

        foreach ($priceFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = (int) str_replace(',', '', $data[$field]);
            }
        }

        return $data;
    }
}
