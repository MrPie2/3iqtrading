<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loan';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Investor_id' => 'integer',
        'Monthly_Salary' => 'integer',
        'Credit_Amount' => 'integer',
        'Transaction_Pin' => 'integer',
        'Status' => 'integer',
    ];
}
