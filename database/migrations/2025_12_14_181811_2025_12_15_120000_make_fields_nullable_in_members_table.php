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
            $table->string('contact_details')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('member_type')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('contact_details')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->string('member_type')->nullable(false)->change();
            $table->date('date_of_birth')->nullable(false)->change();
        });
    }
};
