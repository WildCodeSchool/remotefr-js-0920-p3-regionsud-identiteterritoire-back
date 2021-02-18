<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('code_insee')->unique();
            $table->string('nom')->nullable();
            $table->string('slug')->nullable();
            $table->string('departement')->nullable();
            $table->string('region')->nullable();
            $table->string('epci')->nullable();
            $table->string('nature_epci')->nullable();
            $table->string('arrondissement')->nullable();
            $table->string('canton_ville')->nullable();
            $table->string('population')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('academie')->nullable();
            $table->text('text')->nullable();
            $table->index(['slug', 'code_insee']);
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
        Schema::dropIfExists('communes');
    }
}
