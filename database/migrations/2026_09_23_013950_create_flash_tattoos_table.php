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
        Schema::create('flash_tattoos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image_url');
            $table->text('description')->nullable();
            $table->decimal('price_clp', 12, 2)->default(60000.00);
            $table->decimal('price_usd', 10, 2)->default(65.00);
            $table->string('size_cm')->nullable();
            $table->string('recommended_zone')->nullable();
            $table->foreignId('style_id')->nullable()->constrained('tattoo_styles')->onDelete('set null');
            $table->boolean('is_claimed')->default(false);
            $table->string('claimed_by_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        if (Schema::hasTable('booking_requests') && ! Schema::hasColumn('booking_requests', 'flash_tattoo_id')) {
            Schema::table('booking_requests', function (Blueprint $table) {
                $table->foreignId('flash_tattoo_id')->nullable()->after('client_id')->constrained('flash_tattoos')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('booking_requests') && Schema::hasColumn('booking_requests', 'flash_tattoo_id')) {
            Schema::table('booking_requests', function (Blueprint $table) {
                $table->dropForeign(['flash_tattoo_id']);
                $table->dropColumn('flash_tattoo_id');
            });
        }

        Schema::dropIfExists('flash_tattoos');
    }
};
