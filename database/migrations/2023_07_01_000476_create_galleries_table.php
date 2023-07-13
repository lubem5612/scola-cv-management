<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends  Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cv_id')->constrained('cvs')->cascadeOnDelete();
            $table->string('slug')->index();
            $table->string('photo', 700)->index();
            $table->string('extension', 20)->index();
            $table->float('size', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}

