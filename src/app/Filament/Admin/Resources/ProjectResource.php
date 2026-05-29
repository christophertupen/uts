<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Project')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn (Set $set, ?string $state) => $set('slug', Str::slug($state))
                    ),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('projects'),

                Forms\Components\TextInput::make('github_url')
                    ->label('GitHub URL')
                    ->url(),

                Forms\Components\TextInput::make('demo_url')
                    ->label('Demo URL')
                    ->url(),

                Forms\Components\Select::make('status')
                    ->options([
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                    ])
                    ->default('ongoing')
                    ->required(),

                Forms\Components\TextInput::make('progress_percent')
                    ->label('Progress Laporan (%)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

                Tables\Columns\TextColumn::make('progress_percent')
                    ->label('Progress (%)')
                    ->suffix('%'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}