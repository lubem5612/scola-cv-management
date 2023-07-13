<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends  Migration
{
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cv_id')->constrained('cvs')->cascadeOnDelete();
            $table->string('slug')->index();
            $table->string('extension', 20)->index();
            $table->string('file', 700);
            $table->float('size', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credentials');
    }
}

