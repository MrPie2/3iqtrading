<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizationToken extends Model
{
    protected $table = 'autorization_token';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];
}
