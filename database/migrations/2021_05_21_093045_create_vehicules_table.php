<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modele_id');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('user_id');
            $table->string('transmission');
            $table->string('type_energie');
            $table->string('plaque');
            $table->integer('nombre_place');
            $table->string('annee_fabrication');
            $table->string('annee_sortie');
            $table->string('etat')->nullable();
            $table->timestamps();
            $table->foreign('modele_id')
                ->references('id')
                ->on('modeles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('categorie_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('vehicules');
    }
}
