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
            $table->bigIncrements('id');	
       
            $table->string('user_ip')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->string('secret_token_code');
            $table->string('quantity');	
            $table->string('price');	
            $table->string('payment_method');
            $table->boolean('payment_status')->default(0);
            $table->string('delivery_method');
            $table->boolean('delivery_status')->default(0);
            $table->string('transection_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('shipping_name');
            $table->text('shipping_phone');
            $table->text('shipping_address');

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
