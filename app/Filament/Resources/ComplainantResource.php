<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainantResource\Pages;
use App\Filament\Resources\ComplainantResource\RelationManagers;
use App\Models\Complainant;
use App\Rules\IdentifierRule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainantResource extends Resource
{
    protected static ?string $model = Complainant::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('filament.resources.complainant.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.complainant.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label(__('filament.resources.complainant.attrs.full_name'))
                            ->required()
                            ->maxLength(127),
                        Forms\Components\TextInput::make('identifier')
                            ->label(__('filament.resources.complainant.attrs.identifier'))
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(127)
                            ->rules([new IdentifierRule()]),
                        Forms\Components\TextInput::make('password')
                            ->label(__('filament.resources.complainant.attrs.password'))
                            ->required(fn($operation) => $operation == 'create')
                            ->password()
                            ->maxLength(255)
                            ->dehydrated(fn($state) => !$state),
                        Forms\Components\DatePicker::make('birthdate')
                            ->label(__('filament.resources.complainant.attrs.birthdate')),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('filament.resources.complainant.attrs.full_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('identifier')
                    ->label(__('filament.resources.complainant.attrs.identifier'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->label(__('filament.resources.complainant.attrs.birthdate'))
                    ->date('Y-m-d')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->label(__('filament.resources.complainant.attrs.is_verified'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.resources.general.attrs.created_at'))
                    ->date('Y-m-d')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('verify')
                    ->label(__('filament.resources.complainant.actions.verify'))
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn($record) => !$record->is_verified)
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->update(['is_verify' => true])),
                Tables\Actions\Action::make('activities')
                    ->label(__('filament.resources.general.actions.activities'))
                    ->icon('heroicon-o-newspaper')
                    ->url(fn($record) =>
                        ComplainantResource::getUrl('activities', ['record' => $record])),
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
            'index' => Pages\ManageComplainants::route('/'),
            'activities' => Pages\ComplainantActivities::route('/{record}/activities'),
        ];
    }
}
