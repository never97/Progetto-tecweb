<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedeOreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schede_ore', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('data_odierna');
            $table->integer('ore_unitarie')->default(1);
            $table->text('note')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('progetto_id')->constrained('progetti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schede_ore');
    }
}
