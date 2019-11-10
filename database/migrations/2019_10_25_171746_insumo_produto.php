<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsumoProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo_produto', function (Blueprint $table) {
            $table->integer('produto_id')->unsigned();
            $table->integer('insumo_id')->unsigned();
            $table->float('quantidade');
            $table->primary(['insumo_id', 'produto_id']);
            $table->foreign('produto_id')->references('id')->on('produto')->onDelete('cascade');
            $table->foreign('insumo_id')->references('id')->on('insumo')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumo_produto');
    }
}
