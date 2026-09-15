<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('Page_Name');
                $table->longText('Page_Contents');
                $table->integer('Status')->default(0);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
