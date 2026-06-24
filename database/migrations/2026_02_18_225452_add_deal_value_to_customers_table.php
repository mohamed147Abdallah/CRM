<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add new fields.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Add a financial field (max 15 digits with 2 decimal places)
            $table->decimal('deal_value', 15, 2)->default(0)->after('phone');
            
            // Add a formal priority field instead of relying on the phone field
            $table->string('priority')->default('standard')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['deal_value', 'priority']);
        });
    }
};