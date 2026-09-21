<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationDocument extends Model
{
    protected $table = 'VerificationDocs';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Status' => 'integer',
    ];
}
