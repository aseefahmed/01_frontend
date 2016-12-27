<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmployees0918 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_no');
            $table->string('title', 6);
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('town');
            $table->string('district');
            $table->string('postcode');
            $table->date('dob');
            $table->string('tel');
            $table->string('mob');
            $table->date('join_date');
            $table->string('salary');
            $table->string('acc_holder');
            $table->string('acc_no');
            $table->string('branch');
            $table->string('city');
            $table->string('ifsc_code');
            $table->boolean('dept_head');
            $table->boolean('flag');
            $table->integer('supervisor');
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
        Schema::drop('employees');
    }
}
