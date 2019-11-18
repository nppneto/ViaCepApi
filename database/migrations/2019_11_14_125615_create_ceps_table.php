<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cep', 10);
            $table->string('logradouro', 100)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 80)->nullable();
            $table->string('localidade', 25)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('unidade')->nullable();
            $table->string('ibge')->nullable();
            $table->string('gia')->nullable();
            $table->enum('updated', array('yes', 'no'))->default('no');
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
        Schema::dropIfExists('ceps');
    }
}
