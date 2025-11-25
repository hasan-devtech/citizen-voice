<?php

namespace App\Filament\Resources;

use App\Enums\ComplaintStatusEnum;
use App\Filament\Resources\ComplaintResource\Pages;
use App\Filament\Resources\ComplaintResource\RelationManagers;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 0;

    public static function getModelLabel(): string
    {
        return __('filament.resources.complaint.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.complaint.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('complainant_id')
                    ->label(__('filament.resources.complaint.attrs.complainant'))
                    ->relationship('complainant', 'full_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('complaint_category_id')
                    ->label(__('filament.resources.complaint.attrs.complaint_category'))
                    ->relationship('complaintCategory', 'name_' . app()->getLocale())
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('agency_id')
                    ->label(__('filament.resources.complaint.attrs.agency'))
                    ->relationship('agency', 'name_ar')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('location_id')
                    ->label(__('filament.resources.complaint.attrs.location'))
                    ->relationship('location', 'name_' . app()->getLocale())
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('title')
                    ->label(__('filament.resources.complaint.attrs.title'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label(__('filament.resources.complaint.attrs.description'))
                    ->required()
                    ->maxLength(16000)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complainant.full_name')
                    ->label(__('filament.resources.complaint.attrs.complainant'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('complaintCategory.name_' . app()->getLocale())
                    ->label(__('filament.resources.complaint.attrs.complaint_category'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('agency.name_' . app()->getLocale())
                    ->label(__('filament.resources.complaint.attrs.agency'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.name_' . app()->getLocale())
                    ->label(__('filament.resources.complaint.attrs.location'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_number')
                    ->label(__('filament.resources.complaint.attrs.reference_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.resources.complaint.attrs.title'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label(__('filament.resources.complaint.attrs.status'))
                    ->tooltip(fn($record) => match ($record->status->value) {
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                    })
                    ->icon(
                        fn($record) => match ($record->status->value) {
                            'pending' => 'heroicon-o-question-mark-circle',
                            'processing' => 'heroicon-o-magnifying-glass-circle',
                            'resolved' => 'heroicon-o-check-circle',
                            'rejected' => 'heroicon-o-x-circle',
                        }
                    )
                    ->color(fn($record) => match ($record->status->value) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'resolved' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.resources.general.attrs.created_at'))
                    ->date('Y-m-d')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\Action::make('reject')
                        ->label(__('filament.resources.complaint.actions.reject'))
                        ->visible(fn($record) => $record->status != ComplaintStatusEnum::REJECTED && $record->status == ComplaintStatusEnum::PENDING)
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['status' => ComplaintStatusEnum::REJECTED]);
                            $messaging = $messaging = app('firebase.messaging');
                            $message = CloudMessage::withTarget('token', $record->routeNotificationForFcm[0])
                                ->withNotification(Notification::create(
                                    'Status Updated',
                                    "Case {$record->reference_number} is updated, its status now " . ComplaintStatusEnum::REJECTED->value
                                ));

                            $messaging->send($message);
                        }),

                    Tables\Actions\Action::make('processing')
                        ->label(__('filament.resources.complaint.actions.processing'))
                        ->visible(fn($record) => $record->status == ComplaintStatusEnum::PENDING)
                        ->color('info')
                        ->icon('heroicon-o-magnifying-glass-circle')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['status' => ComplaintStatusEnum::PROCESSING]);

                            $messaging = $messaging = app('firebase.messaging');
                            $message = CloudMessage::withTarget('token', $record->routeNotificationForFcm[0])
                                ->withNotification(Notification::create(
                                    'Status Updated',
                                    "Case {$record->reference_number} is updated, its status now " . ComplaintStatusEnum::PROCESSING->value
                                ));

                            $messaging->send($message);
                        }),

                    Tables\Actions\Action::make('resolved')
                        ->label(__('filament.resources.complaint.actions.resolved'))
                        ->visible(fn($record) => $record->status == ComplaintStatusEnum::PROCESSING)
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['status' => ComplaintStatusEnum::RESOLVED]);

                            $messaging = $messaging = app('firebase.messaging');
                            $message = CloudMessage::withTarget('token', $record->routeNotificationForFcm[0])
                                ->withNotification(Notification::create(
                                    'Status Updated',
                                    "Case {$record->reference_number} is updated, its status now " . ComplaintStatusEnum::RESOLVED->value
                                ));

                            $messaging->send($message);
                        }),

                    Tables\Actions\EditAction::make()
                        ->slideOver()
                        ->modalWidth(MaxWidth::ThreeExtraLarge),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ManageComplaints::route('/'),
        ];
    }
}
