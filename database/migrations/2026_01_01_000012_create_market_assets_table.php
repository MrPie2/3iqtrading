<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('market_assets', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->decimal('change_percent', 7, 2);
            $table->string('category')->default('stock');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('market_assets');
    }
};
