<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_panne');
            $table->unsignedBigInteger('piece_id');
            $table->unsignedBigInteger('vehicule_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('fournisseur_id');
            $table->integer('nombre');
            $table->integer('prix_toto_piece');
            $table->integer('main_oeuvre');
            $table->integer('toto_conso');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('piece_id')
                ->references('id')
                ->on('pieces')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('fournisseur_id')
                ->references('id')
                ->on('fournisseurs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('vehicule_id')
                ->references('id')
                ->on('vehicules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparations');
    }
}
