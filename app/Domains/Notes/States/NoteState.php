<?php

namespace App\Domains\Notes\States;

use Thunk\Verbs\State;

class NoteState extends State
{
    public ?string $eventUuid;

    public ?string $noteUuid;

    /**
     * @var array{
     *     title: string,
     *     content: string,
     *     user_id: int,
     * }
     */
    public array $data;
}
