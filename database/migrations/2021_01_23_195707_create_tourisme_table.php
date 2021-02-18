<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourismeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourismes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('www', 600)->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('description')->nullable();
            $table->string('code_insee')->nullable();
            $table->text('geolocalisation')->nullable();
            // $table->text('geo_shape')->nullable();
            $table->index(['code_insee']);
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
        Schema::dropIfExists('tourismes');
    }
}
