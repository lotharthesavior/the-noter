<?php

namespace App\Domains\Notes\Events;

use App\Domains\Notes\Enums\SubmissionType;
use App\Domains\Notes\Services\NoteService;
use App\Events\ResourceEvent;
use Illuminate\Support\Arr;
use Thunk\Verbs\Event;

class NoteSubmitted extends Event
{
    public ?string $noteUuid = null;

    public array $data = [];

    public string $submissionType;

    public function handle()
    {
        $this->processNoteService();
        $this->sendEventMessageBus();
    }

    public function fired()
    {
        switch ($this->submissionType) {
            case SubmissionType::CREATE->value:
                NoteCreated::fire(noteUuid: $this->noteUuid, data: $this->data);
                break;
            case SubmissionType::UPDATE->value:
                NoteUpdated::fire(noteUuid: $this->noteUuid, data: $this->data);
                break;
            case SubmissionType::DELETE->value:
                NoteDeleted::fire(noteUuid: $this->noteUuid);
                break;
        }
    }

    private function processNoteService()
    {
        $noteService = app(NoteService::class);

        switch ($this->submissionType) {
            case SubmissionType::CREATE->value:
                $noteService->create(
                    uuid: $this->noteUuid,
                    data: Arr::only($this->data, ['title', 'content', 'user_uuid', 'user_name']),
                );
                break;
            case SubmissionType::UPDATE->value:
                $noteService->update(
                    uuid: $this->noteUuid,
                    data: Arr::only($this->data, ['title', 'content']),
                );
                break;
            case SubmissionType::DELETE->value:
                $noteService->delete($this->noteUuid);
                break;
        }
    }

    private function sendEventMessageBus()
    {
        event(new ResourceEvent(
            resourceUuid: $this->noteUuid,
            resource: 'note',
            action: $this->submissionType,
            userUuid: Arr::get($this->data, 'user_uuid'),
        ));
    }
}
