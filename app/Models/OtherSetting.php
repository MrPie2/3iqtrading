<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherSetting extends Model
{
    protected $table = 'others';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}
