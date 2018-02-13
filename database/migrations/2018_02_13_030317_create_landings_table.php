<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->default(0);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('metakeywords')->nullable();
            $table->string('metadescription')->nullable();
            $table->string('picture')->nullable();
            $table->string('cover')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->integer('price')->nullable();
            $table->integer('views')->default(0);
            $table->float('rank')->default(5);
            $table->softDeletes();
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
        Schema::dropIfExists('landings');
    }
}
