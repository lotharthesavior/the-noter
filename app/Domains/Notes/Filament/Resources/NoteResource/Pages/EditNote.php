<?php

namespace App\Domains\Notes\Filament\Resources\NoteResource\Pages;

use App\Domains\Notes\Enums\SubmissionType;
use App\Domains\Notes\Events\NoteSubmitted;
use App\Domains\Notes\Filament\Resources\NoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditNote extends EditRecord
{
    protected static string $resource = NoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Delete Note')
                ->action(fn () => $this->handleRecordDeletion($this->record)),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data = array_merge($record->only(
            'title', 'content', 'user_uuid', 'user_name',
        ), [
            'title' => Arr::get($data, 'title'),
            'content' => Arr::get($data, 'content'),
        ]);

        NoteSubmitted::commit(
            noteUuid: $record->uuid,
            submissionType: SubmissionType::UPDATE->value,
            data: $data,
        );

        return $record->fresh();
    }

    protected function handleRecordDeletion(Model $record): void
    {
        NoteSubmitted::commit(
            noteUuid: $record->uuid,
            submissionType: SubmissionType::DELETE->value,
            data: [
                'user_uuid' => $record->user_uuid,
                'user_name' => $record->user_name,
            ],
        );

        $this->redirect(NoteResource::getUrl());
    }
}
