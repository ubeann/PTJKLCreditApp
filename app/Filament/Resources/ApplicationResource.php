<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Main')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Personal Information')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Forms\Components\Section::make('Basic Details')
                                    ->icon('heroicon-o-user')
                                    ->description('Enter the basic details of the consumer.')
                                    ->schema([
                                        Forms\Components\TextInput::make('consumer_name')
                                            ->required()
                                            ->maxLength(255)
                                            ->label('Full Name')
                                            ->placeholder('Enter full name'),
                                        Forms\Components\TextInput::make('nik')
                                            ->required()
                                            ->maxLength(255)
                                            ->label('NIK')
                                            ->placeholder('Enter NIK'),
                                        Forms\Components\DatePicker::make('birthdate')
                                            ->required()
                                            ->label('Date of Birth'),
                                    ])->columns(3),

                                Forms\Components\Section::make('Additional Information')
                                    ->icon('heroicon-o-user-plus')
                                    ->description('Enter additional information about the consumer.')
                                    ->schema([
                                        Forms\Components\Select::make('marital_status')
                                            ->label('Marital Status')
                                            ->required()
                                            ->native(false)
                                            ->options([
                                                'single' => 'Single',
                                                'married' => 'Married',
                                                'divorced' => 'Divorced',
                                                'widowed' => 'Widowed',
                                            ]),
                                        Forms\Components\TextInput::make('spouse_data')
                                            ->maxLength(255)
                                            ->label('Spouse Name')
                                            ->placeholder('Enter spouse name')
                                            ->visible(fn ($get) => $get('marital_status') === 'married'),
                                    ])->columns(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Vehicle Information')
                            ->icon('heroicon-o-truck')
                            ->schema([
                                Forms\Components\Section::make('Dealer Information')
                                    ->icon('heroicon-o-globe-americas')
                                    ->description('Enter the dealer information.')
                                    ->schema([
                                        Forms\Components\TextInput::make('dealer')
                                            ->required()
                                            ->maxLength(255)
                                            ->label('Dealer Name')
                                            ->placeholder('Enter dealer name'),
                                    ]),

                                Forms\Components\Section::make('Vehicle Details')
                                    ->icon('heroicon-o-truck')
                                    ->description('Enter the vehicle details.')
                                    ->schema([
                                        Forms\Components\Select::make('vehicle_brand')
                                            ->label('Brand')
                                            ->required()
                                            ->native(false)
                                            ->searchable()
                                            ->options([
                                                'Toyota' => 'Toyota',
                                                'Honda' => 'Honda',
                                                'Suzuki' => 'Suzuki',
                                                'Mitsubishi' => 'Mitsubishi',
                                                'Daihatsu' => 'Daihatsu',
                                                'Isuzu' => 'Isuzu',
                                                'Nissan' => 'Nissan',
                                                'Mazda' => 'Mazda',
                                                'Mercedes-Benz' => 'Mercedes-Benz',
                                                'BMW' => 'BMW',
                                                'Audi' => 'Audi',
                                                'Volkswagen' => 'Volkswagen',
                                                'Ford' => 'Ford',
                                                'Chevrolet' => 'Chevrolet',
                                                'Jeep' => 'Jeep',
                                                'Land Rover' => 'Land Rover',
                                                'Porsche' => 'Porsche',
                                                'Lexus' => 'Lexus',
                                                'Subaru' => 'Subaru',
                                                'KIA' => 'KIA',
                                                'Hyundai' => 'Hyundai',
                                                'Peugeot' => 'Peugeot',
                                                'Volvo' => 'Volvo',
                                                'Jaguar' => 'Jaguar',
                                                'MINI' => 'MINI',
                                                'Ferrari' => 'Ferrari',
                                                'Bentley' => 'Bentley',
                                                'Rolls-Royce' => 'Rolls-Royce',
                                                'Lamborghini' => 'Lamborghini',
                                                'Maserati' => 'Maserati',
                                                'McLaren' => 'McLaren',
                                                'Aston Martin' => 'Aston Martin',
                                                'Alfa Romeo' => 'Alfa Romeo',
                                                'Lotus' => 'Lotus',
                                                'Bugatti' => 'Bugatti',
                                                'Pagani' => 'Pagani',
                                                'Koenigsegg' => 'Koenigsegg',
                                                'Ferrari' => 'Ferrari',
                                                'Tesla' => 'Tesla',
                                                'Polestar' => 'Polestar',
                                                'Lucid' => 'Lucid',
                                                'Rivian' => 'Rivian',
                                                'Byton' => 'Byton',
                                                'Rimac' => 'Rimac',
                                                'NIO' => 'NIO',
                                                'Xpeng' => 'Xpeng',
                                            ]),
                                        Forms\Components\TextInput::make('vehicle_model')
                                            ->label('Model')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('vehicle_type')
                                            ->label('Type')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\ColorPicker::make('vehicle_color')
                                            ->label('Color')
                                            ->required(),
                                    ])->columns(2),

                                Forms\Components\Section::make('Pricing')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->description('Enter the pricing information.')
                                    ->schema([
                                        Forms\Components\TextInput::make('vehicle_price')
                                            ->label('Price')
                                            ->required()
                                            ->prefix('Rp')
                                            ->inputMode('numeric')
                                            ->mask(RawJs::make('$money($input)'))
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Loan Details')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                Forms\Components\Section::make('Loan Information')
                                    ->icon('heroicon-o-banknotes')
                                    ->description('Enter the loan information.')
                                    ->schema([
                                        Forms\Components\Select::make('loan_insurance')
                                            ->label('Loan Insurance')
                                            ->required()
                                            ->native(false)
                                            ->options([
                                                'yes' => 'Yes',
                                                'no' => 'No',
                                            ]),
                                        Forms\Components\TextInput::make('down_payment')
                                            ->label('Down Payment')
                                            ->required()
                                            ->inputMode('numeric')
                                            ->prefix('Rp')
                                            ->mask(RawJs::make('$money($input)')),
                                        Forms\Components\TextInput::make('loan_term_months')
                                            ->label('Loan Term')
                                            ->required()
                                            ->numeric()
                                            ->inputMode('numeric')
                                            ->suffix('months'),
                                        Forms\Components\TextInput::make('monthly_installment')
                                            ->label('Monthly Installment')
                                            ->required()
                                            ->inputMode('numeric')
                                            ->prefix('Rp')
                                            ->mask(RawJs::make('$money($input)')),
                                    ])->columns(2),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('consumer_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('spouse_data')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dealer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loan_insurance')
                    ->searchable(),
                Tables\Columns\TextColumn::make('down_payment')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loan_term_months')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monthly_installment')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
