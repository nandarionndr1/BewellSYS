<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BCSupplierOrderDetailLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BC_Supplier_Order_Detail_Logs', function (Blueprint $table) {
            $table->increments('query_id');
            $table->integer('userID');
            $table->timestamp('query_date');
            $table->string('query_type');
            $table->string('id');
            $table->string('orderID');
            $table->string('supplyID');
            $table->string('spdt_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BC_Supplier_Order_Detail_Logs');
    }
}
