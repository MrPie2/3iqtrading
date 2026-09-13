<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('3iq:about', function () {
    $this->info('3IQ Trading website is running.');
})->purpose('Display a simple 3IQ Trading status message');
