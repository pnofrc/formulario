<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OspitalitaResource\Pages;
use App\Filament\Resources\OspitalitaResource\RelationManagers;
use App\Models\Ospitalita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OspitalitaResource extends Resource
{
    protected static ?string $model = Ospitalita::class;

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
                      ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
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
    ->defaultItems(1)
    ->columnSpanFull()

    
,

                Forms\Components\TextInput::make('chi_sei')
                    ->label('Chi sei')
                    ->nullable(),

                Forms\Components\Toggle::make('artista_evento')
                    ->label('Artista Evento')
                    ->required(),

                Forms\Components\Toggle::make('paga_ospitalita')
                    ->label('Paga Ospitalità')
                    ->default(true)
                    ->reactive(),

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


                Forms\Components\TextInput::make('eventi_extra')
                    ->label('Eventi Extra')
                      ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                    ->json()
                    ->nullable(),

                Forms\Components\Toggle::make('mandata_mail')
                  ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
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
                    if (is_array($state)) {
                        return collect($state)->join(', ');
                    }
                    if (is_string($state) && $state !== '') {
                        return collect(json_decode($state, true) ?: explode(',', $state))->join(', ');
                    }
                    return '-';
                })
                ->wrap()
            ,

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

            Tables\Columns\IconColumn::make('paga_ospitalita')
                ->label('Paga')
                ->boolean(),

            Tables\Columns\IconColumn::make('pagato')
                ->label('Pagato')
                ->boolean(),

            Tables\Columns\IconColumn::make('confermato')
                ->label('Confermato')
                ->boolean(),

            Tables\Columns\TextColumn::make('data_arrivo')
                ->label('Arrivo')
                ->date('d/m/Y'),

            Tables\Columns\TextColumn::make('data_partenza')
                ->label('Partenza')
                ->date('d/m/Y'),
        ])
        ->filters([
            Tables\Filters\TernaryFilter::make('paga_ospitalita')
                ->label('Paga ospitalità'),

            Tables\Filters\TernaryFilter::make('pagato')
                ->label('Pagato'),

            Tables\Filters\TernaryFilter::make('confermato')
                ->label('Confermato'),
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
            'index' => Pages\ListOspitalitas::route('/'),
            'create' => Pages\CreateOspitalita::route('/create'),
            'edit' => Pages\EditOspitalita::route('/{record}/edit'),
        ];
    }
}
