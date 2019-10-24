<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 45);
            $table->float('quantidade');
            $table->decimal('custo', 14,2);
            $table->integer('categoria_id')->unsigned()->index('fk_categoria_insumo');
            $table->integer('unidade_id')->unsigned()->index('fk_unidade');
            $table->integer('user_id')->unsigned()->index('fk_usuario');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos');
    }
}
