<?php

namespace App\Domains\Reports\Events;

use App\Domains\Reports\Models\ResourceUsage;
use Thunk\Verbs\Event;

class ResourceUsageSubmitted extends Event
{
    public ?string $eventUuid = null;

    public ?string $resourceUuid = null;

    public ?string $resource = null;

    public ?string $action = null;

    public ?string $userUuid = null;

    public function handle()
    {
        ResourceUsage::create([
            'uuid' => $this->eventUuid,
            'resource_uuid' => $this->resourceUuid,
            'resource' => $this->resource,
            'action' => $this->action,
            'user_uuid' => $this->userUuid,
        ]);
    }

    public function fired()
    {
        ResourceUsageCreated::fire(eventUuid: $this->eventUuid);
    }
}
