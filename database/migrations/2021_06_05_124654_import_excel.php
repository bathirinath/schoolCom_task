<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportExcel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('section');
            $table->integer('admission_no');
            $table->integer('roll_no');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('dob');
            $table->integer('mobile');
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
        Schema::dropIfExists('student_data');
    }
}
