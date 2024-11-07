<?php

namespace App\Domains\Notes\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasUuids;

    protected $table = 'notes';

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'title',
        'content',
        'user_uuid',
        'user_name',
    ];

    protected $casts = [
        'uuid' => 'string',
        'user_uuid' => 'string',
        'user_name' => 'string',
        'title' => 'string',
        'content' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
