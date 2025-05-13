<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RumoreResource\Pages;
use App\Filament\Resources\RumoreResource\RelationManagers;
use App\Models\Rumore;
use Filament\Tables\Filters\TernaryFilter;
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

class RumoreResource extends Resource
{
    protected static ?string $model = Rumore::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            TextInput::make('numero_telefono')
                ->required()
                ->maxLength(30),
            Toggle::make('pagato_iscrizione')
                ->label('Ha pagato iscrizione'),
            Toggle::make('volontari')
                ->label('Volontario'),
            Toggle::make('cibo')
                ->label('Vuole il cibo'),
            Textarea::make('intolleranze')
                ->rows(2)
                ->maxLength(255),
            TextInput::make('costo_totale')
                ->label('Costo Totale (€)')
                ->numeric()
                ->prefix('€')
                ->step(0.01)
                ->default(0)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('nome')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cognome')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('numero_telefono'),
                Tables\Columns\IconColumn::make('pagato_iscrizione')->boolean(),
                Tables\Columns\IconColumn::make('volontari')->boolean(),
                Tables\Columns\IconColumn::make('cibo')->boolean(),
                Tables\Columns\TextColumn::make('intolleranze')->limit(20),
                Tables\Columns\TextColumn::make('costo_totale')
                    ->money('eur', locale: 'it')
                    ->sortable(),
            ])
            ->filters([
                 TernaryFilter::make('volontari'),
                TernaryFilter::make('pagato_iscrizione'),
                TernaryFilter::make('cibo'),
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
            'index' => Pages\ListRumores::route('/'),
            'create' => Pages\CreateRumore::route('/create'),
            'edit' => Pages\EditRumore::route('/{record}/edit'),
        ];
    }
}
