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
        Schema::create('table_address', function (Blueprint $table) {
            $table->id();
            $table->integer('CEP');
            $table->string('Longadouro');
            $table->string('Bairro');
            $table->string('Cidade');
            $table->string('UF');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_address');
    }
};
