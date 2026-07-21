<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Select::make('category')
                    ->options([
                        'Web' => 'Web',
                        'Mobile' => 'Mobile',
                        'Design' => 'Design',
                        'API' => 'API',
                        'Other' => 'Other',
                    ])
                    ->native(false)
                    ->searchable(),
                Toggle::make('featured')
                    ->label('Featured project'),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->directory('projects')
                    ->columnSpanFull(),
                TextInput::make('project_url')
                    ->label('Live URL')
                    ->url()
                    ->maxLength(255),
                TextInput::make('repo_url')
                    ->label('Repository URL')
                    ->url()
                    ->maxLength(255),
            ]);
    }
}
