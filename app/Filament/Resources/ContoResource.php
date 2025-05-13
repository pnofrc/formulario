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
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Hidden;

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
                    ->default(false)->afterStateUpdated(function (callable $set, $state) {
                        $set('pagato', $state);
                    }),
                
                Hidden::make('pagato')
                    ->default(false),


                DatePicker::make('data_arrivo')
                    ->label('Data di arrivo?')
                    ->default('01/06/2025')
                    ->closeOnDateSelection(),
                
                DatePicker::make('data_partenza')
                    ->label('Data di partenza?')
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
                        ->default(true)
                        ->reactive(),
        
                    Forms\Components\Select::make('numero_ospiti')
                        ->label('Numero ospiti')
                        ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                        ->options([1 => '1', 2 => '2'])
                        ->required()
                        ->reactive(),
        
                    Forms\Components\Toggle::make('paga_biancheria')
                        ->label('Lenzuola?')
                        ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                        ->default(false),
        
                    Forms\Components\Select::make('tipologia_stanza')
                        ->label('Tipologia stanza')
                        ->visible(fn (Forms\Get $get) => $get('paga_ospitalita'))
                        ->options([
                            'camerata' => 'Camerata',
                            'cameratina' => 'Cameratina',
                            'camerella' => 'Camerella',
                        ])
                        ->required()
                        ->reactive(),
        
                    Forms\Components\TextInput::make('costo_pasto_giornaliero')
                        ->label('Costo cibo/giorno')
                        ->visible(fn (Forms\Get $get) => !$get('paga_ospitalita'))
                        ->numeric()
                        ->default(5)
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
                        ->defaultItems(0)
                        ->reorderable(),
        
                ])->visible(fn (Forms\Get $get) => !$get('artista_evento'))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime(),

                    ToggleColumn::make('pagato')
                        ->label('Saldato?'),
                
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
