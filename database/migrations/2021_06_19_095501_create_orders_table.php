<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('cart_id');
            $table->integer('billing_address_id');
            $table->integer('shipping_address_id');
            $table->integer('status_id');
            $table->integer('invoice_id');
            $table->float('subtotal', 8, 2);
            $table->float('shipping', 4, 2);
            $table->float('tax', 4, 2)->default(0.0);
            $table->float('total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
