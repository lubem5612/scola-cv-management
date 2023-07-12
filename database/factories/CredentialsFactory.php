<?php

namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Http\Models\Credential;
use Transave\ScolaCvManagement\Http\Models\User;


class CredentialsFactory extends Factory
{
    protected $model = Credential::class;

    public function definition()
    {
        return [
        'fileType' => $this->faker->name,
        'user_id' => user::factory(),
        'file' => UploadedFile::fake()->image('profile.jpg')
        ];
    }
}
