<?php

namespace App\Domains\Reports\Models;

use App\Domains\Reports\Enums\Resource;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ResourceUsage extends Model
{
    use HasUuids;

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'uuid';

    protected $table = 'resource_usage';

    protected $fillable = [
        'uuid',
        'resource_uuid',
        'resource',
        'action',
        'user_uuid',
    ];

    protected $casts = [
        'uuid' => 'string',
        'resource_uuid' => 'string',
        'resource' => 'string',
        'action' => 'string',
        'user_uuid' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
