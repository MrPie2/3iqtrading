<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUserControl extends Model
{
    protected $table = 'admin_user_controls';
    protected $guarded = [];
    protected $casts = [
        'investor_id' => 'integer',
        'withdrawal_banned' => 'boolean',
        'swift_code' => 'string',
    ];
}
