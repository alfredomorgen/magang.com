<?php

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
            $table->integer('company_id')->unsigned()->index();
            $table->integer('job_category_id')->unsigned()->index();

            $table->string('name');
            $table->dateTime('deadline');
            $table->string('location');
            $table->integer('type');
            $table->integer('salary');
            $table->integer('period');
            $table->text('benefit')->nullable();
            $table->text('requirement');
            $table->text('description');
            $table->integer('status');

            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
