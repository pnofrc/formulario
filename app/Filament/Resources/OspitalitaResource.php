<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OspitalitaResource\Pages;
use App\Filament\Resources\OspitalitaResource\RelationManagers;
use App\Models\ospitalita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OspitalitaResource extends Resource
{
    protected static ?string $model = ospitalita::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_ospiti')
                    ->label('Numero Ospiti')
                    ->numeric()
                    ->default(1)
                    ->minValue(1)
                    ->required()
                    ->reactive(),
                    

                Forms\Components\Repeater::make('nome')
                    ->label('Nomi')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome')
                            ->required(),
                    ])
                    ->minItems(1)
                    ->maxItems(fn (callable $get) => (int) ($get('numero_ospiti') ?? 1))
                    ->defaultItems(1),

                Forms\Components\TextInput::make('chi_sei')
                    ->label('Chi sei')
                    ->nullable(),

                // Forms\Components\Toggle::make('artista_evento')
                //     ->label('Artista Evento')
                //     ->required(),

                // Forms\Components\Toggle::make('paga_ospitalita')
                //     ->label('Paga Ospitalità')
                //     ->default(true)
                //     ->reactive(),

                Forms\Components\Toggle::make('iscrizione')
                    ->label('Iscrizione')
                    ->default(false),

                Forms\Components\Toggle::make('lingua_italiano')
                    ->label('Lingua Italiano')
                    ->default(true),


                Forms\Components\DatePicker::make('data_partenza')
                    ->label('Data Partenza')
                    ->displayFormat('d/m/Y')
                    ->default(now()->setYear(2025))
                    ->nullable(),

                Forms\Components\DatePicker::make('data_arrivo')
                    ->label('Data Arrivo')
                    ->displayFormat('d/m/Y')
                    ->default(now()->setYear(2025))
                    ->nullable(),

                Forms\Components\Select::make('tipologia_stanza')
                    ->label('Tipologia Stanza')
                    ->options([
                        'camerata condivisa' => 'Camerata Condivisa',
                        'camerella privata' => 'Camerella Privata',
                    ])
                    ->nullable(),


                Forms\Components\Repeater::make('eventi_extra')
                    ->label('Regola conti eventi extra')
                    ->schema([
                        Forms\Components\TextInput::make('descrizione')
                            ->label('Descrizione')
                            ->required(),

                        Forms\Components\TextInput::make('valore')
                            ->label('Valore')
                            ->numeric()
                            ->required(),
                    ])
                    ->addActionLabel('Aggiungi evento')
                    ->default([])
                    ->nullable(),

                Forms\Components\Toggle::make('mandata_mail')
                    ->label('Mandata Mail?')
                    ->default(false),

                Forms\Components\Toggle::make('pagato')
                
                    ->label('Pagato?')
                    ->default(false),
                
                Forms\Components\Toggle::make('confermato')
                
                    ->label('Confermato?')
                    ->default(false),
            ]);
    }

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nome')
    ->label('Nomi')
    ->formatStateUsing(function ($state) {
        $names= str_replace('{"nome":"', '', $state);
        $names = str_replace('"}', '', $names);
       return $names;
    })
    ->wrap(),



            Tables\Columns\TextColumn::make('numero_ospiti')
                ->label('N. Ospiti'),

            Tables\Columns\TextColumn::make('tipologia_stanza')
                ->label('Stanza')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'camerata condivisa' => 'info',
                    'camerella privata' => 'success',
                    default => 'secondary',
                }),

            Tables\Columns\ToggleColumn::make('mandata_mail')
                ->label('Mail?'),

            Tables\Columns\ToggleColumn::make('confermato')
                ->label('Confermato?'),

            Tables\Columns\ToggleColumn::make('iscrizione')
                ->label('Iscrizione?'),

            Tables\Columns\ToggleColumn::make('pagato')
                ->label('Pagato?'),


            Tables\Columns\TextColumn::make('data_arrivo')
                ->label('Arrivo')
                ->date('d/m'),

            Tables\Columns\TextColumn::make('data_partenza')
                ->label('Partenza')
                ->date('d/m'),
        ])
        ->filters([
            // Tables\Filters\TernaryFilter::make('paga_ospitalita')
            //     ->label('Paga ospitalità'),

            Tables\Filters\TernaryFilter::make('pagato')
                ->label('Pagato'),

            Tables\Filters\TernaryFilter::make('confermato')
                ->label('Confermato'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListOspitalitas::route('/'),
            'create' => Pages\CreateOspitalita::route('/create'),
            'edit' => Pages\EditOspitalita::route('/{record}/edit'),
        ];
    }
}
