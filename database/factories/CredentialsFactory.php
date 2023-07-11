<?php

namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Http\Models\Credential;


class CredentialsFactory extends Factory
{
    protected $model = Credential::class;

    public function definition()
    {
        return [
        'fileName' => $this->faker->name,
        'users_id' => config('scolacv.auth_model')::factory(),
        'doctype' => UploadedFile::fake()->image('profile.jpg')
        ];
    }
}
