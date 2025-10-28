<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                DateTimePicker::make('email_verified_at')
                    ->label('Verifikasi Email'),

                TextInput::make('password')
                    ->password()
                    ->label('Kata Sandi')
                    ->required(fn ($record) => $record === null),

                // Dropdown Role
                Select::make('role_id')
                    ->label('Role Pengguna')
                    ->relationship('role', 'nama_role')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
