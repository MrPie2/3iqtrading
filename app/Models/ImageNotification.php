<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageNotification extends Model
{
    protected $table = 'imagenotification';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Investor_id' => 'integer',
        'seen' => 'integer',
    ];
}
