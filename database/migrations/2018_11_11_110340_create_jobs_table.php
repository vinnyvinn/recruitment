<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('designation_id')->unsigned()->nullable();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->string('experience');
            $table->enum('job_type', ['Contractual','Part Time.','Full Time']);
            $table->string('age');
            $table->string('job_location');
            $table->string('salary_range');
            $table->text('short_description');
            $table->date('post_date');
            $table->date('ldate');
            $table->date('cdate');
            $table->enum('status', ['Closed', 'Open', 'Drafted']);
            $table->text('description');
            $table->integer('no_position');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('jobs');
    }
}
