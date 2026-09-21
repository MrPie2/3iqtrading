<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeNote extends Model
{
    protected $table = 'welcomenote';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}
