<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('agent');
            $table->string('buyer');
            $table->date('delivery_date');
            $table->tinyinteger('gg');
            $table->integer('qty');
            $table->double('fob');
            $table->double('weight_per_dzn');
            $table->double('qty_per_dzn');
            $table->double('total_yarn_weight');
            $table->double('total_yarn_cost');
            $table->double('acc_rate');
            $table->double('total_acc_cost');
            $table->double('btn_cost');
            $table->double('total_btn_cost');
            $table->double('zipper_cost');
            $table->double('total_zipper_cost');
            $table->double('print_cost');
            $table->double('total_print_cost');
            $table->double('total_fob');
            $table->double('total_cost');
            $table->double('balance_amount');
            $table->double('cost_of_making');
            $table->string('compositions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
