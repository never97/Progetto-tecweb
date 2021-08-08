<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssegnazioniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assegnazioni', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('data_assegnazione');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('progetto_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('progetto_id')->references('id')->on('progetti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assegnazioni');
    }
}
