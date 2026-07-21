<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageProfile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $navigationLabel = 'About Me';

    protected static ?int $navigationSort = -1;

    public ?array $data = [];

    public function getTitle(): string
    {
        return 'About Me';
    }

    public function mount(): void
    {
        $this->form->fill(Profile::current()->toArray());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Basic Information')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('title')
                        ->label('Job Title / Tagline')
                        ->maxLength(255),
                    TextInput::make('years_experience')
                        ->label('Years of Experience')
                        ->numeric()
                        ->default(0),
                    FileUpload::make('avatar')
                        ->image()
                        ->avatar()
                        ->disk('public')
                        ->directory('profile'),
                ]),
            Section::make('About')
                ->schema([
                    Textarea::make('bio')
                        ->label('Bio / About Me')
                        ->rows(6)
                        ->columnSpanFull(),
                ]),
            Section::make('Contact')
                ->columns(2)
                ->schema([
                    TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('location')
                        ->maxLength(255),
                    FileUpload::make('resume')
                        ->label('Resume / CV (PDF)')
                        ->disk('public')
                        ->directory('profile')
                        ->acceptedFileTypes(['application/pdf']),
                ]),
            Section::make('Social Links')
                ->schema([
                    Repeater::make('socials')
                        ->schema([
                            Select::make('platform')
                                ->options([
                                    'github' => 'GitHub',
                                    'linkedin' => 'LinkedIn',
                                    'twitter' => 'X / Twitter',
                                    'facebook' => 'Facebook',
                                    'instagram' => 'Instagram',
                                    'whatsapp' => 'WhatsApp',
                                    'youtube' => 'YouTube',
                                    'website' => 'Website',
                                ])
                                ->native(false)
                                ->required(),
                            TextInput::make('url')
                                ->url()
                                ->required(),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('Add social link')
                        ->reorderable(false)
                        ->columnSpanFull(),
                ]),
            Section::make('Highlights')
                ->description('Shown as animated counters on the homepage, e.g. "50" / "Projects Completed".')
                ->schema([
                    Repeater::make('highlights')
                        ->schema([
                            TextInput::make('value')
                                ->required()
                                ->maxLength(20),
                            TextInput::make('label')
                                ->required()
                                ->maxLength(60),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('Add stat')
                        ->reorderable(false)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')
                            ->label('Save')
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Profile::current()->update($data);

        Notification::make()
            ->title('Profile updated')
            ->success()
            ->send();
    }
}
