<?php

namespace App\Domains\Notes\Filament\Resources\NoteResource\Pages;

use App\Domains\Notes\Enums\SubmissionType;
use App\Domains\Notes\Events\NoteCreated;
use App\Domains\Notes\Events\NoteSubmitted;
use App\Domains\Notes\Filament\Resources\NoteResource;
use App\Domains\Notes\Models\Note;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateNote extends CreateRecord
{
    protected static string $resource = NoteResource::class;

    /**
     * @param array{
     *     title: string,
     *     content: string,
     * } $data
     * @return Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        $user = auth()->user();

        $data = [
            'title' => Arr::get($data, 'title'),
            'content' => Arr::get($data, 'content'),
            'user_uuid' => $user->id,
            'user_name' => $user->name,
        ];

        $uuid = Str::uuid()->toString();

        NoteSubmitted::commit(
            noteUuid: $uuid,
            submissionType: SubmissionType::CREATE->value,
            data: $data,
        );

        return Note::find($uuid);
    }
}
