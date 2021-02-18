<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourismeIllustrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourismes_illustrations', function (Blueprint $table) {
            $table->id();
            $table->integer('tourisme_id')->nullable();
            $table->string('code_insee')->nullable();
            $table->string('type')->nullable();
            $table->string('nom')->nullable();
            $table->string('urlDiaporama',600)->nullable();
            $table->string('url',600)->nullable();
            $table->integer('hauteur')->nullable();
            $table->integer('largeur')->nullable();
            $table->integer('taille')->nullable();
            $table->string('copyright',900)->nullable();
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
        Schema::dropIfExists('tourismes_illustrations');
    }
}
