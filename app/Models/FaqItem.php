<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqItem extends Model
{
    protected $table = 'faqs';
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'sort_order' => 'integer',
        'active' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
