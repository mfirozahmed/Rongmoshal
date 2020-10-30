<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('main')->nullable();

            $table->foreign('main')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('sub')->nullable();

            $table->foreign('sub')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('sub_sub')->nullable();

            $table->foreign('sub_sub')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('product_categories');
    }
}
