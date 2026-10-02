<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('investors', 'email_verification_token')) {
            Schema::table('investors', function (Blueprint $table): void {
                $table->string('email_verification_token', 64)->nullable()->index();
            });
        }

        if (!Schema::hasColumn('investors', 'email_verification_expires_at')) {
            Schema::table('investors', function (Blueprint $table): void {
                $table->dateTime('email_verification_expires_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('investors', 'email_verification_token')) {
            Schema::table('investors', function (Blueprint $table): void {
                $table->dropIndex(['email_verification_token']);
                $table->dropColumn('email_verification_token');
            });
        }

        if (Schema::hasColumn('investors', 'email_verification_expires_at')) {
            Schema::table('investors', function (Blueprint $table): void {
                $table->dropColumn('email_verification_expires_at');
            });
        }
    }
};
