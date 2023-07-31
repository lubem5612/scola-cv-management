<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_qualifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cv_id')->constrained('cvs')->cascadeOnDelete();
            $table->foreignId('qualification_id')->constrained('qualifications')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->cascadeOnDelete();
            $table->string('institution')->index();
            $table->text('description')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
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
        Schema::dropIfExists('educational_qualifications');
    }
};
