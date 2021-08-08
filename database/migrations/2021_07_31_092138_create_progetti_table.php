<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgettiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progetti', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 30);
            $table->text('descrizione');
            $table->text('note')->nullable();
            $table->date('data_inizio_prevista');
            $table->date('data_fine_prevista');
            $table->integer('data_fine_effettiva')->nullable();
            $table->double('costo_orario')->default(1);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clienti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progetti');
    }
}
