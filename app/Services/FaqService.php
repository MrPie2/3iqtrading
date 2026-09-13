<?php

namespace App\Services;

use App\Models\Faq;

class FaqService
{
    public function active()
    {
        return Faq::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->get();
    }
}
