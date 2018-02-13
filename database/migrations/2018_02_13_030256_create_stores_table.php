<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
          $table->increments('id');
          $table->string('user_id')->default(0);
          $table->string('name')->nullable();
          $table->string('slug')->unique();
          $table->string('city')->nullable();
          $table->string('address')->nullable();
          $table->float('lat')->default(0);
          $table->float('lng')->default(0);
          $table->string('phone')->nullable();
          $table->string('mobile')->nullable();
          $table->string('schedule')->nullable();
          $table->string('facebook')->nullable();
          $table->string('twitter')->nullable();
          $table->string('tags')->nullable();
          $table->text('description')->nullable();
          $table->text('content')->nullable();
          $table->string('metakeywords')->nullable();
          $table->string('metadescription')->nullable();
          $table->string('logo')->nullable();
          $table->string('cover')->nullable();
          $table->string('colorset')->nullable();
          $table->integer('views')->default(0);
          $table->integer('callbacks')->default(0);
          $table->float('rank')->default(5);
          $table->boolean('active')->default(false);
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
        Schema::dropIfExists('stores');
    }
}
