<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarburantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carburants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicule_id');
            $table->string('type_carburant');
            $table->integer('quantite');
            $table->integer('prix_unitaire');
            $table->integer('prix_total');
            $table->integer('distance');
            $table->integer('distance_litre');
            $table->timestamps();
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
        Schema::dropIfExists('carburants');
    }
}
