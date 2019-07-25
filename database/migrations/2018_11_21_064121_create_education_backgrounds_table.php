<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('areastudied_id')->unsigned()->nullable();
            $table->integer('certificate_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('startdate');
            $table->string('enddate')->nullable();
            $table->timestamps();
        });

        Schema::table('education_backgrounds', function (Blueprint $table) {
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('areastudied_id')->references('id')->on('area_studies')->onDelete('cascade');
            $table->foreign('certificate_id')->references('id')->on('degree_certificates')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_backgrounds');
    }
}
