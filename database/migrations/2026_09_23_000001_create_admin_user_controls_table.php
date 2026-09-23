<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_user_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id')->unique();
            $table->boolean('withdrawal_banned')->default(false);
            $table->string('signal')->nullable();
            $table->string('swift_code', 32)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_user_controls');
    }
};
