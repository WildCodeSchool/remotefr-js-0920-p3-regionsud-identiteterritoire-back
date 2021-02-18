<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeocommuneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geocommunes', function (Blueprint $table) {
            $table->id();
            $table->string('code_insee')->nullable();
            $table->string('altitude')->nullable();
            $table->string('superficie')->nullable();
            $table->string('population')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('geo_shape')->nullable();
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
        Schema::dropIfExists('geocommunes');
    }
}
