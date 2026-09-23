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
        // 1. Admin Users
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Clients
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 3. Tattoo Styles
        Schema::create('tattoo_styles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 4. Booking Requests (Tattoo Agenda)
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->text('description');
            $table->string('size')->nullable();
            $table->string('body_zone')->nullable();
            $table->dateTime('preferred_date');
            $table->string('preferred_time_slot')->nullable(); // Morning, Afternoon
            $table->string('budget')->nullable();
            $table->string('location')->default('Metro Santa Ana - Santiago Centro');
            $table->json('references')->nullable();
            $table->string('status')->default('PENDING'); // PENDING, APPROVED, REJECTED, CANCELLED
            $table->timestamps();
        });

        // 5. Appointments
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('booking_request_id')->nullable()->unique()->constrained('booking_requests')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status')->default('CONFIRMED'); // CONFIRMED, COMPLETED, CANCELLED, REPROGRAMMED
            $table->string('payment_status')->default('UNPAID'); // UNPAID, PAID, REFUNDED
            $table->decimal('deposit_amount', 10, 2)->default(30000.00);
            $table->dateTime('paid_at')->nullable();
            $table->string('location')->default('Metro Santa Ana - Santiago Centro');
            $table->decimal('price', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['start_time', 'end_time']);
        });

        // 6. Availability Rules
        Schema::create('availability_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('day_of_week'); // 0 (Sunday) to 6 (Saturday)
            $table->string('start_time'); // "HH:mm"
            $table->string('end_time');   // "HH:mm"
            $table->timestamps();
        });

        // 7. Time Blocks
        Schema::create('time_blocks', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('type')->default('OTHER'); // LUNCH, VACATION, CLOSED, PERSONAL, OTHER
            $table->string('description')->nullable();
            $table->timestamps();

            $table->index(['start_time', 'end_time']);
        });

        // 8. Portfolio Items (Art & Drawings & Flash)
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->default('drawings'); // drawings, paintings, tattoos, sketches
            $table->string('medium')->nullable(); // Grafito sobre papel, Tinta china, Óleo, etc.
            $table->string('dimensions')->nullable(); // e.g. 30x42 cm
            $table->string('year')->nullable();
            $table->foreignId('style_id')->nullable()->constrained('tattoo_styles')->onDelete('set null');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 9. Products for Sale (Drawings, Originals, Prints)
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('technique')->nullable(); // Grafito, Carbón, Tintas
            $table->string('dimensions')->nullable();
            $table->string('category')->default('dibujos'); // dibujos, originales, prints, merchandising
            $table->string('main_image');
            $table->json('gallery_images')->nullable();
            $table->decimal('base_price_clp', 12, 2)->default(0);
            $table->decimal('base_price_usd', 10, 2)->default(0);
            $table->boolean('has_original')->default(false);
            $table->boolean('original_sold')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 10. Product Variants / Formats (Original, Print A3, Print A4, etc.)
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('format_name'); // 'Pieza Original', 'Fine Art Print A3 (Algodón 310g)', 'Fine Art Print A4'
            $table->string('format_type')->default('PRINT'); // ORIGINAL, PRINT, CANVAS
            $table->decimal('price_usd', 10, 2);
            $table->decimal('price_clp', 12, 2);
            $table->decimal('price_eur', 10, 2);
            $table->decimal('price_mxn', 10, 2);
            $table->integer('stock')->default(1);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        // 11. Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_country')->default('Chile');
            $table->string('currency', 3)->default('USD');
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_gateway')->default('PAYPAL');
            $table->string('payment_status')->default('PENDING'); // PENDING, PAID, CANCELLED, REFUNDED
            $table->string('paypal_order_id')->nullable();
            $table->string('paypal_payer_id')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // 12. Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->onDelete('set null');
            $table->string('product_title');
            $table->string('variant_name');
            $table->decimal('price', 12, 2);
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // 13. Site Settings
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('products');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('portfolio_items');
        Schema::dropIfExists('time_blocks');
        Schema::dropIfExists('availability_rules');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('booking_requests');
        Schema::dropIfExists('tattoo_styles');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('admin_users');
    }
};
