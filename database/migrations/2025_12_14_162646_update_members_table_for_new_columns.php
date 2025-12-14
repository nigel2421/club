<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('phone_number')->nullable();
            $table->date('doj')->nullable();
            $table->string('profession')->nullable();
            $table->string('race')->nullable();
            $table->decimal('minimum_spent', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'doj', 'profession', 'race', 'minimum_spent']);
        });
    }
};
