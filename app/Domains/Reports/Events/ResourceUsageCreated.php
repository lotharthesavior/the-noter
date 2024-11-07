<?php

namespace App\Domains\Reports\Events;

use Thunk\Verbs\Event;
use Thunk\Verbs\Facades\Verbs;

class ResourceUsageCreated extends Event
{
    public ?string $eventUuid = null;

    public function handle()
    {
        // customize this to fit this case here (not using other domain)
        // Verbs::unlessReplaying(function () {
        //     auth()->user()->notify(new NoteNotification(SubmissionType::CREATE));
        // });
    }
}
