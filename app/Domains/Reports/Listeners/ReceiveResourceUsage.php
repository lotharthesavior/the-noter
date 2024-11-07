<?php

namespace App\Domains\Reports\Listeners;

use App\Domains\Reports\Events\ResourceUsageSubmitted;
use App\Events\ResourceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class ReceiveResourceUsage implements ShouldQueue
{
    /**
     * @param ResourceEvent $event
     * @return void
     */
    public function handle(ResourceEvent $event): void
    {
        logger()->info('resource used', [
            'event' => $event,
        ]);

        ResourceUsageSubmitted::fire(
            eventUuid: Str::uuid()->toString(),
            resourceUuid: $event->resourceUuid,
            resource: $event->resource,
            action: $event->action,
            userUuid: $event->userUuid,
        );
    }
}
