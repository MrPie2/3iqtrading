<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table="faqs";
    
    protected $fillable = ['question', 'answer'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }
}
