<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSuppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_name');
            $table->text('description');
            $table->string('image_thumbnail');
            $table->string('contact_person');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('Town');
            $table->string('City');
            $table->string('post_code');
            $table->string('country_code', 3);
            $table->string('email');
            $table->tinyInteger('supplier_type_id');
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
        Schema::drop('suppliers');
    }
}
