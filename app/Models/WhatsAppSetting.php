<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppSetting extends Model
{
    protected $table = 'whatsapp';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}
