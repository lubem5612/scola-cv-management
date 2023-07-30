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
            $table->uuid('id')->primary();
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->foreignUuid('school_id')->nullable()->constrained('schools')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('department_id')->nullable()->constrained('departments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('qualification_id')->nullable()->constrained('qualifications')->cascadeOnDelete();
            $table->foreignUuid('faculty_id')->nullable()->constrained('faculties')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('country_of_origin_id')->nullable()->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('country_of_residence_id')->nullable()->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lg_of_residence_id')->nullable()->constrained('lgs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lg_of_origin_id')->nullable()->constrained('lgs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('state_of_origin')->nullable()->constrained('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('state_of_resident')->nullable()->constrained('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('picture', 700)->nullable();
            $table->string('token')->nullable();
            $table->boolean('is_verified')->default(false)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type')->default('user');
            $table->string('phone', 20)->unique()->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('marital_status', 50)->nullable();
            $table->string('residential_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->timestamp('dob')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->string('status', 40)->default('active');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('users')
            ->insert([
                'id' => \Illuminate\Support\Str::uuid(),
                'first_name' => 'Scola-CV',
                'last_name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'user_type' => 'admin',
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
