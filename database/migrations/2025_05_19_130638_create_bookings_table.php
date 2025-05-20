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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');
        $table->dateTime('start_time');
        $table->dateTime('end_time');
        $table->string('destination');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->enum('level', ['0', '1', '2'])->default('0');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
