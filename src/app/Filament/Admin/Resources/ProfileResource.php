<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Profile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                Forms\Components\TextInput::make('role')
                    ->label('Role')
                    ->required(),

                Forms\Components\Textarea::make('bio')
                    ->label('Bio')
                    ->required(),

                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('profiles'),

                Forms\Components\TextInput::make('email')
                    ->email(),

                Forms\Components\TextInput::make('phone')
                    ->label('Nomor HP'),

                Forms\Components\TextInput::make('github_url')
                    ->label('GitHub URL')
                    ->url(),

                Forms\Components\TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->url(),

                Forms\Components\TextInput::make('whatsapp_url')
                    ->label('WhatsApp URL')
                    ->url()
                    ->helperText('Contoh: https://wa.me/6281234567890'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}