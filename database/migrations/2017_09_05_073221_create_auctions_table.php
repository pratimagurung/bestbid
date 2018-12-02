<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('auctionname');
            $table->decimal('startprice',8,2);
            $table->string('auctionstate')->default('Unsold');
            $table->unsignedInteger('product_id');
            $table->dateTime('startdate');
            $table->dateTime('enddate');
            $table->double('bidincrement',8,2)->default(1);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('auctions');
        Schema::enableForeignKeyConstraints();
    }
}
