<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add the user_id relationship.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Add the employee ID field and link it to the users table.
            // It is made nullable temporarily to avoid errors with existing records.
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Drop the foreign key and the column.
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};