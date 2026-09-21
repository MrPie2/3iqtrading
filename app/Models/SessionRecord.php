<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionRecord extends Model
{
    protected $table = 'sessions';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'user_id' => 'integer',
        'last_activity' => 'integer',
    ];
}
