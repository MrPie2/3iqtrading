<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramSetting extends Model
{
    protected $table = 'telegram';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}
