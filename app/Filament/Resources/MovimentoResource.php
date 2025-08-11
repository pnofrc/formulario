<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimentoResource\Pages;
use App\Filament\Resources\MovimentoResource\RelationManagers;
use App\Models\Movimento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;



class MovimentoResource extends Resource
{
    protected static ?string $model = Movimento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

             public static function canAccess(): bool
     {
         return auth()->check() && in_array(auth()->user()->id, [1]);
     }
     
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'entrata' => 'Entrata',
                        'uscita' => 'Uscita',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('voce')
                    ->label('Voce')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('importo')
                    ->label('Importo')
                    ->numeric()
                    ->required(),

                Forms\Components\Toggle::make('cibo')
                    ->label('è per cibo?'),

                Forms\Components\Select::make('metodo_pagamento')
                    ->label('Metodo pagamento')
                    ->options([
                        'contante' => 'Contante',
                        'paypal' => 'PayPal',
                        'pos' => 'POS',
                    ])
                    ->nullable(),

                Forms\Components\Toggle::make('pagato')
                    ->label('Pagato')
                    ->default(true),

                Forms\Components\Textarea::make('note')
                    ->label('Note')
                    ->rows(3)
                    ->nullable(),

                 Forms\Components\TextInput::make('extra')
                    ->integer()
                    ->nullable(),

                Forms\Components\FileUpload::make('foto_scontrino')
                    ->label('Foto Scontrino')
                    ->image()
                    ->directory('scontrini')
                    ->nullable(),

                DatePicker::make('updated_at')
                    ->format('d/m/Y')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo')->label('Tipo')->sortable(),
                Tables\Columns\TextColumn::make('voce')->label('Voce')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('importo')->label('Importo')->money('eur', true)->sortable(),
                Tables\Columns\BooleanColumn::make('cibo')->label('Cibo')->sortable(),
                Tables\Columns\TextColumn::make('metodo_pagamento')->label('Metodo Pagamento')->sortable(),
                Tables\Columns\TextColumn::make('note')->label('Note')->limit(50),
                Tables\Columns\ImageColumn::make('foto_scontrino')->label('Foto Scontrino')->rounded()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListMovimentos::route('/'),
            'create' => Pages\CreateMovimento::route('/create'),
            'edit' => Pages\EditMovimento::route('/{record}/edit'),
        ];
    }
}
