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
    protected $guarded = [];

    public function getAuthPassword(): string
    {
        return (string) $this->Password;
    }

    public function getAuthPasswordName(): string
    {
        return 'Password';
    }

    public function getRememberTokenName(): string
    {
        return '';
    }

    protected $casts = [
        'id' => 'integer',
        'Fin_Asset' => 'float',
        'Total_Deposit' => 'float',
        'Level' => 'integer',
        'Status' => 'integer',
        'V_Status' => 'integer',
        'LockStatus' => 'integer',
        'exchangerate' => 'float',
        'swift_code_switch' => 'integer',
    ];
}