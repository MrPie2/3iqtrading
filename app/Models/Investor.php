<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Investor extends Authenticatable
{
    protected $table = 'investors';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = ['Password'];
    public function getAuthPassword() { return $this->Password; }
    public function getRememberTokenName() { return null; }
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Fin_Asset' => 'float',
        'Total_Deposit' => 'integer',
        'Level' => 'integer',
        'Status' => 'integer',
        'V_Status' => 'integer',
        'LockStatus' => 'integer',
        'exchangerate' => 'integer',
        'swift_code_switch' => 'integer',
    ];
}
