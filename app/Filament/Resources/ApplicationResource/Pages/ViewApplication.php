<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ColorEntry;

class ViewApplication extends ViewRecord
{
    protected static string $resource = ApplicationResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextEntry::make('consumer_name')
                            ->label('Full Name'),
                        TextEntry::make('nik')
                            ->label('NIK'),
                        TextEntry::make('birthdate')
                            ->label('Date of Birth')
                            ->date(),
                        TextEntry::make('marital_status')
                            ->label('Marital Status')
                            ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                        TextEntry::make('spouse_data')
                            ->label('Spouse Name')
                            ->visible(fn ($record): bool => $record->marital_status === 'married'),
                    ])->columns(2),

                Section::make('Vehicle Information')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        TextEntry::make('dealer')
                            ->label('Dealer Name'),
                        TextEntry::make('vehicle_brand')
                            ->label('Brand'),
                        TextEntry::make('vehicle_model')
                            ->label('Model'),
                        TextEntry::make('vehicle_type')
                            ->label('Type'),
                        ColorEntry::make('vehicle_color')
                            ->label('Color'),
                        TextEntry::make('vehicle_price')
                            ->label('Price')
                            ->money('IDR'),
                    ])->columns(3),

                Section::make('Loan Details')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        IconEntry::make('loan_insurance')
                            ->label('Loan Insurance')
                            ->icon(fn (string $state): string => $state === 'yes' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn (string $state): string => $state === 'yes' ? 'success' : 'danger'),
                        TextEntry::make('down_payment')
                            ->label('Down Payment')
                            ->money('IDR'),
                        TextEntry::make('loan_term_months')
                            ->label('Loan Term')
                            ->suffix(' months'),
                        TextEntry::make('monthly_installment')
                            ->label('Monthly Installment')
                            ->money('IDR'),
                    ])->columns(2),
            ]);
    }
}
