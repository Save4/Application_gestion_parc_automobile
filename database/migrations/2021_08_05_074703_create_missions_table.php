<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicule_id');
            $table->unsignedBigInteger('departement_id');
            $table->unsignedBigInteger('chauffeur_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type_mission');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('etat_mission')->nullable();
            $table->timestamps();
            $table->foreign('vehicule_id')
                ->references('id')
                ->on('vehicules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('departement_id')
                ->references('id')
                ->on('departements')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('chauffeur_id')
                ->references('id')
                ->on('chauffeurs')
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
        Schema::dropIfExists('missions');
    }
}
