<?php

namespace App\Domains\Notes\Events;

use App\Domains\Notes\States\NoteState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

abstract class NoteEvent extends Event
{
    #[StateId(NoteState::class)]
    public ?string $noteUuid = null;
}
