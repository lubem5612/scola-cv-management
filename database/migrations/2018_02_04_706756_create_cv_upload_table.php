<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvUploadTable extends Migration
{
    public function up()
    {
        Schema::create('cv_upload', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('cvName');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cv_upload');
    }
}
