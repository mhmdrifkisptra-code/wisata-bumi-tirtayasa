<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
                $table->index(['user_id', 'created_at']);
            }

            if (!Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->default('PENDING')->after('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('bookings', 'user_id')) $table->dropConstrainedForeignId('user_id');
        });
    }
};
