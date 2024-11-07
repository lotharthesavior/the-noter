<?php

namespace App\Domains\Notes\Enums;

enum SubmissionType: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
}
