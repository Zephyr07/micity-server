<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom')->unique();
            $table->integer('telephone')->unique();
            $table->string('genre');
            $table->string('image')->nullable();
            $table->integer('utilisateurs_id')->unsigned()->index()->unique();
            $table->foreign('utilisateurs_id')->references('id')->on('users');
            $table->string('statut')->default('new');
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
        Schema::dropIfExists('clients');
    }
}
