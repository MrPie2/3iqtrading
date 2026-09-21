<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobBatch extends Model
{
    protected $table = 'job_batches';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'total_jobs' => 'integer',
        'pending_jobs' => 'integer',
        'failed_jobs' => 'integer',
        'cancelled_at' => 'integer',
        'created_at' => 'integer',
        'finished_at' => 'integer',
    ];
}
