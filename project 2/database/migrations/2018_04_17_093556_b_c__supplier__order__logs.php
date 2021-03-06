<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BCSupplierOrderLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BC_Supplier_Order_Logs', function (Blueprint $table) {
            $table->increments('query_id');
            $table->integer('userID');
            $table->timestamp('query_date');
            $table->string('query_type');
            $table->string('id');
            $table->string('spod_date');
            $table->string('spod_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BC_Supplier_Order_Logs');
    }
}
