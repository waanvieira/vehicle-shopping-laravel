<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->unsigned();            
            $table->integer('tag_id')->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('city_url')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('uf_url', 2)->nullable();
            $table->integer('type')->nullable();
            $table->integer('brand')->nullable();
            $table->integer('model')->nullable();
            $table->integer('version')->nullable();
            $table->integer('regdate')->nullable();
            $table->integer('gearbox')->nullable();
            $table->integer('fuel')->nullable();
            $table->integer('steering')->nullable();
            $table->integer('motor_power')->nullable();
            $table->integer('doors')->nullable();
            $table->integer('color')->nullable();
            $table->integer('cubic_cms')->nullable();
            $table->integer('owner')->nullable();
            $table->integer('mileage')->nullable();
            $table->json('features')->nullable();
            $table->json('moto_features')->nullable();
            $table->json('financials')->nullable();
            $table->double('price')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();                            

            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
