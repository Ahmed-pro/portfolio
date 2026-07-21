<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('category')
                    ->options([
                        'Backend' => 'Backend',
                        'Frontend' => 'Frontend',
                        'Database' => 'Database',
                        'DevOps' => 'DevOps',
                        'Design' => 'Design',
                        'Other' => 'Other',
                    ])
                    ->native(false)
                    ->searchable(),
                Slider::make('level')
                    ->label('Proficiency (%)')
                    ->range(0, 100)
                    ->step(5)
                    ->default(80)
                    ->required(),
            ]);
    }
}
