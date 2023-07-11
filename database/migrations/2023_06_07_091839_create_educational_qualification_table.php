<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalQualificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_qualification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('institutionName');
            $table->foreignId('department_id');
            $table->string('courseStudy');
            $table->foreignId('Qualifications_id');
            $table->string('startDate');
            $table->string('endDate');
            $table->string('country');
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
        Schema::dropIfExists('educational_qualification');
    }
};
