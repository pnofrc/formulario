<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuaResource\Pages;
use App\Filament\Resources\QuaResource\RelationManagers;
use App\Models\Qua;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\TernaryFilter;

class QuaResource extends Resource
{
    protected static ?string $model = Qua::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
     {
         return auth()->check() && in_array(auth()->user()->id, [1,2]);
     }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                ->required()
                ->maxLength(255),
            TextInput::make('cognome')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Toggle::make('mandata_mail')
                ->default(false)
                ->label('Mandata mail recap?'),
            
            Select::make('metodo_pagamento')
                ->label('Denaro inviato')
                ->options([
                        'paypal' => 'paypal',
                        'iban' => 'iban',
                        'cash' => 'cash',
                    ])
                    ->default('paypal')
                    ->nullable(),

             Toggle::make('fatta_iscrizione')
                ->default(false)
                ->label('Compilata iscrizione?'),

            Toggle::make('pagato_iscrizione')
                ->default(false)
                ->label('Pagato iscrizione?'),

            Toggle::make('dato_tessera')
                ->default(false)
                ->label('Consegnata tessera?'),

            Toggle::make('dentro_ca_monti')
                ->default(false)
                ->label('Dentro a Ca de Monti?'),

            TextInput::make('note')
                    ->nullable(),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('dentro_ca_monti'),
                 Tables\Columns\TextColumn::make('nome')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cognome')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                 Tables\Columns\ToggleColumn::make(name: 'mandata_mail'),
                 Tables\Columns\SelectColumn::make('metodo_pagamento') ->options([
                        'paypal' => 'paypal',
                        'iban' => 'iban',
                        'cash' => 'cash',
                    ]),
                Tables\Columns\ToggleColumn::make('fatta_iscrizione'),
                Tables\Columns\ToggleColumn::make('pagato_iscrizione'),
                Tables\Columns\ToggleColumn::make(name: 'data_tessera'),
            ])
            ->filters([
                TernaryFilter::make('volontari'),
                TernaryFilter::make('pagato_iscrizione'),
                TernaryFilter::make('cibo'),
                TernaryFilter::make('mandata_mail'),
                TernaryFilter::make(name: 'dentro_ca_monti'),
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
            'index' => Pages\ListQuas::route('/'),
            'create' => Pages\CreateQua::route('/create'),
            'edit' => Pages\EditQua::route('/{record}/edit'),
        ];
    }
}
