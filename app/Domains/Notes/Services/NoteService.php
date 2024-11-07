<?php

namespace App\Domains\Notes\Services;

use App\Domains\Notes\Models\Note;
use Illuminate\Support\Arr;

class NoteService
{
    public function create(
        string $uuid,
        array $data
    ): Note {
        $note = Note::find($uuid);
        if ($note !== null) {
            return $note;
        }

        return Note::create(array_merge([
            'uuid' => $uuid,
        ], Arr::only($data, ['title', 'content', 'user_uuid', 'user_name'])));
    }

    public function update(
        string $uuid,
        array $data,
    ): Note {
        $note = Note::findOrFail($uuid);
        $note->update(Arr::only($data, ['title', 'content']));

        return $note;
    }

    public function delete(string $uuid): void
    {
        Note::findOrFail($uuid)->delete();
    }
}
