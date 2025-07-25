<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // In the migration file:
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        $table->timestamp('cancelled_at')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
