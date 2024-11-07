<?php

namespace App\Domains\Reports\Filament\Resources;

use App\Domains\Reports\Filament\Resources\UserUsageResource\Pages;
use App\Domains\Reports\Models\ResourceUsage;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserUsageResource extends Resource
{
    protected static ?string $model = ResourceUsage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('Uuid'),
                Tables\Columns\TextColumn::make('resource_uuid')
                    ->label('Resource Uuid'),
                Tables\Columns\TextColumn::make('resource')
                    ->label('Resource'),
                Tables\Columns\TextColumn::make('action')
                    ->label('Action'),
                Tables\Columns\TextColumn::make('user_uuid')
                    ->label('User Uuid'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListUserUsages::route('/'),
        ];
    }
}
