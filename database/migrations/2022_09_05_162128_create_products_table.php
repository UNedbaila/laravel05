<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable(false); //nullable Для того что бы поле не могло быть пустым
            $table->string('description',255)->nullable(); //поле может быть пустым
            $table->bigInteger('category_id')->unsigned();
            $table->string('image',255)->nullable();
            $table->integer('price')->unsigned()->nullable(false);
            $table->boolean('active')->default(false); //default значение которое будет по умолчанию
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
        Schema::dropIfExists('products');
    }
};
