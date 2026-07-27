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
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->date('visit_date');
    $table->string('code')->unique();
    $table->integer('total')->default(0);

    $table->enum('status', ['pending','paid','cancelled'])->default('pending');
    $table->string('snap_token')->nullable();
    $table->string('payment_type')->nullable();
    $table->string('payment_status')->nullable();

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
