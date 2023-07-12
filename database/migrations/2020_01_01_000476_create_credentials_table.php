<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends  Migration
{
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('fileType')->index();
            $table->string('file', 700);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credentials');
    }
}

