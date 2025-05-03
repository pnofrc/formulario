<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContoResource\Pages;
use App\Filament\Resources\ContoResource\RelationManagers;
use App\Models\Conto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
class ContoResource extends Resource
{
    protected static ?string $model = Conto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->label('Nome ospite')
                    ->required(),

                Forms\Components\Toggle::make(name: 'artista_evento')
                    ->label('Artista di un evento?')
                    ->reactive()
                    ->default(false),

                DatePicker::make('data_arrivo')
                    ->label('Data di arrivo?')
                    // ->format('d/m/Y')
                    ->default('01/06/2025')
                    ->closeOnDateSelection(),
                
                DatePicker::make('data_partenza')
                    ->label('Data di partenza?')
                    // ->format('d/m/Y')
                    ->default('01/06/2025')
                    ->closeOnDateSelection(),

                Section::make([

                    Forms\Components\Toggle::make('lingua_italiano')
                        ->label('Conto in italiano?')
                        ->default(true),
        
                    Forms\Components\Toggle::make('pagato_iscrizione')
                        ->label('Iscrizione pagata?')
                        ->default(false),
        
                    Forms\Components\Toggle::make('paga_ospitalita')
                        ->label('Paga dormire')

                        // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                        //     $set('costo_totale', ContoResource::calculateCost($get))
                        // )
                        ->default(true)
                        ->reactive(),
        
                    Forms\Components\Select::make('numero_ospiti')
                        ->label('Numero ospiti')
                        ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                        ->options([1 => '1', 2 => '2'])
                        // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                        //     $set('costo_totale', ContoResource::calculateCost($get))
                        // )
                        ->required()
                        ->reactive(),
        
                    Forms\Components\Toggle::make('paga_biancheria')
                        ->label('Lenzuola?')
                        ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                        // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                        //     $set('costo_totale', ContoResource::calculateCost($get))
                        // )
                        ->default(false),
        
                    // Forms\Components\TextInput::make('notti')
                    //     ->label('Numero di notti')
                    //     ->numeric()
                    //     ->required()
                    //     // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                    //     //     $set('costo_totale', ContoResource::calculateCost($get))
                    //     // )
                    //     ->reactive(),
        
                    Forms\Components\Select::make('tipologia_stanza')
                        ->label('Tipologia stanza')
                        ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                        ->options([
                            'camerata' => 'Camerata',
                            'cameratina' => 'Cameratina',
                            'camerella' => 'Camerella',
                        ])
                        ->required()
                        // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                        //     $set('costo_totale', ContoResource::calculateCost($get))
                        // )
                        ->reactive(),
        
                    Forms\Components\TextInput::make('costo_pasto_giornaliero')
                        ->label('Costo cibo/giorno')
                        ->visible(fn (Forms\Get $get) => !$get('paga_ospitalita'))
                        ->numeric()
                        ->default(5)
                        // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                        //     $set('costo_totale', ContoResource::calculateCost($get))
                        // )
                        ->required(),
        
                    Forms\Components\Repeater::make('eventi_extra')
                        ->label('Eventi extra')
                        ->schema([
                            Forms\Components\TextInput::make('descrizione')
                                ->label('Descrizione'),
                            Forms\Components\TextInput::make('costo')
                                ->label('Costo')
                                ->numeric()
                                ->required(),
                        ])
                        // ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) =>
                        //     $set('costo_totale', ContoResource::calculateCost($get))
                        // )
                        ->defaultItems(0)
                        ->reorderable(),

                        // Forms\Components\Placeholder::make('costo_totale_info')
                        // ->label('OCIO!!!!')
                        // ->content('IN CASO DI MODIFICHE, VARIA I GIORNI DI PERMANENZA ED EVENTUALMENTE IL TIPO DI CAMERA!')
                        // ->columnSpan('full'),

        
                    // Forms\Components\TextInput::make('costo_totale')
                    //     ->label('Costo totale')
                    //     ->disabled()
                    //     ->dehydrated()
                    //     ->numeric(),
                ])->visible(fn (Forms\Get $get) => !$get('artista_evento'))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->sortable()->searchable(),
                // Tables\Columns\TextColumn::make('costo_totale')
                //     ->label('Totale')
                //     ->money('EUR')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime(),
                
                    Tables\Columns\TextColumn::make('link_scontrino')
                    ->label('Scontrino')
                    ->default('Apri scontrino')
                    ->formatStateUsing(fn () => 'Apri')
                    ->url(fn (Conto $record) => url("/conto/" . urlencode($record->nome)))
                    ->openUrlInNewTab(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListContos::route('/'),
            'create' => Pages\CreateConto::route('/create'),
            'edit' => Pages\EditConto::route('/{record}/edit'),
        ];
    }
}
