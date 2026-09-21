<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'attempts' => 'integer',
        'reserved_at' => 'integer',
        'available_at' => 'integer',
        'created_at' => 'integer',
    ];
}
