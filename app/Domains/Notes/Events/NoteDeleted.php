<?php

namespace App\Domains\Notes\Events;

use App\Domains\Notes\Enums\SubmissionType;
use App\Domains\Notes\Notifications\NoteNotification;
use App\Domains\Notes\States\NoteState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Facades\Verbs;

class NoteDeleted extends NoteEvent
{
    #[StateId(NoteState::class)]
    public array $data;

    public function handle()
    {
        Verbs::unlessReplaying(function () {
            auth()->user()->notify(new NoteNotification(SubmissionType::DELETE));
        });
    }
}
