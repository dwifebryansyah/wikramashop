<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('product_change')->default(0);
            $table->integer('supplier_change')->default(0);
            $table->integer('order_change')->default(0);
            $table->integer('debt_change')->default(0);
            $table->integer('convert_change')->default(0);
            $table->integer('category_change')->default(0);
            $table->integer('unit_change')->default(0);
            $table->integer('infomation_change')->default(0);
            $table->integer('role_change')->default(0);
            $table->integer('account_change')->default(0);
            $table->datetime('tanggal');
            $table->string('activity');
            $table->string('detail_activity');
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
        Schema::dropIfExists('histories');
    }
}
