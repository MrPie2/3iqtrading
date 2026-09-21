<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseCertificate extends Model
{
    protected $table = 'LicenseCert';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Investor_id' => 'integer',
    ];
}
