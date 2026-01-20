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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('order_number')->unique();
                $table->string('status')->default('pending');
                $table->decimal('subtotal', 10, 2);
                $table->decimal('tax', 10, 2);
                $table->decimal('shipping', 10, 2);
                $table->decimal('total', 10, 2);
                
                // Shipping Info
                $table->string('shipping_first_name');
                $table->string('shipping_last_name');
                $table->string('shipping_email');
                $table->string('shipping_phone')->nullable();
                $table->string('shipping_address1');
                $table->string('shipping_address2')->nullable();
                $table->string('shipping_city');
                $table->string('shipping_state');
                $table->string('shipping_zip');
                $table->string('shipping_country');
                
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->string('product_id')->nullable();
                $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
                $table->string('product_name');
                $table->decimal('product_price', 10, 2);
                $table->integer('quantity');
                $table->decimal('total', 10, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
