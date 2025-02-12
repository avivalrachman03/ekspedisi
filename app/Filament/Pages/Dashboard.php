<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Form;
use Faker\Provider\ar_EG\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;
    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            Section::make('filter')->columns(3)->schema([
                Select::make('user_id')
                    ->options(function () {
                        return User::all()->pluck('name', 'id');
                    }),
                DatePicker::make('startDate'),
                DatePicker::make('endDate'),
            ])
        ]);
    }
}
