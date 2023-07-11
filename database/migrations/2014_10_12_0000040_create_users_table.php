<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->index();
            $table->string('lastName')->index();
            $table->foreignId('faculty_id');
            $table->foreignId('department_id');
            $table->foreignId('qualifications_id')->nullable();
            $table->foreignId('school_id')->index();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('is_verified')->default(false)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->string('state_of_resident')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('dob')->nullable()->nullable();
            $table->string('no_of_children')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();


        });

        \Illuminate\Support\Facades\DB::table('users')
            ->insert([
                'id' => 7,
                'firstName' => 'Scola-CV',
                'lastName' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'user_type' => 'admin',
                'faculty_id' => 9,
                'department_id' => 4,
                'is_verified' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
