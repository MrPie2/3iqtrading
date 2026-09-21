<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'HasChild' => 'integer',
        'Status' => 'integer',
    ];
}
