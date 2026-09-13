<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('minimum_amount', 15, 2);
            $table->decimal('maximum_amount', 15, 2)->nullable();
            $table->string('term_label');
            $table->string('risk_level');
            $table->decimal('illustrative_rate', 5, 2)->nullable();
            $table->text('description');
            $table->json('features')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investment_plans');
    }
};
