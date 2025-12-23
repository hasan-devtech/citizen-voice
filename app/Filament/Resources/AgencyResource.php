<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgencyResource\Pages;
use App\Filament\Resources\AgencyResource\RelationManagers;
use App\Models\Agency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgencyResource extends Resource
{
    protected static ?string $model = Agency::class;

    protected static ?string $navigationIcon = 'heroicon-m-building-library';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('filament.resources.agency.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.agency.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make(__('filament.resources.general.tabs.ar'))
                            ->schema([
                                Forms\Components\TextInput::make('name_ar')
                                    ->label(__('filament.resources.general.attrs.name_ar'))
                                    ->required()
                                    ->maxLength(127),
                                Forms\Components\TextInput::make('description_ar')
                                    ->label(__('filament.resources.general.attrs.description_ar'))
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Tabs\Tab::make(__('filament.resources.general.tabs.en'))
                            ->schema([
                                Forms\Components\TextInput::make('name_en')
                                    ->label(__('filament.resources.general.attrs.name_en'))
                                    ->required()
                                    ->maxLength(127),
                                Forms\Components\TextInput::make('description_en')
                                    ->label(__('filament.resources.general.attrs.description_en'))
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Tabs\Tab::make(__('filament.resources.general.tabs.ku'))
                            ->schema([
                                Forms\Components\TextInput::make('name_ku')
                                    ->label(__('filament.resources.general.attrs.name_ku'))
                                    ->required()
                                    ->maxLength(127),
                                Forms\Components\TextInput::make('description_ku')
                                    ->label(__('filament.resources.general.attrs.description_ku'))
                                    ->maxLength(255),
                            ])
                    ])
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_ar')
                    ->label(__('filament.resources.general.attrs.name_ar'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label(__('filament.resources.general.attrs.name_en'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_ku')
                    ->label(__('filament.resources.general.attrs.name_ku'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.resources.general.attrs.created_at'))
                    ->date('Y-m-d')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('activities')
                    ->label(__('filament.resources.general.actions.activities'))
                    ->icon('heroicon-o-newspaper')
                    ->url(fn($record) =>
                        AgencyResource::getUrl('activities', ['record' => $record])),
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->modalWidth(MaxWidth::ThreeExtraLarge),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated(PAGINATE)
            ->defaultPaginationPageOption(DEFAULT_PAGINATE)
            ->selectCurrentPageOnly()
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAgencies::route('/'),
            'activities' => Pages\AgencyActivities::route('/{record}/activities'),
        ];
    }
}
