<?php

namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Http\Models\Credential;


class CredentialFactory extends Factory
{
    protected $model = Credential::class;

    public function definition()
    {
        return [
            'user_id' => config('scolacv.auth_model')::factory(),
            'slug' => $this->faker->slug,
            'file' => UploadedFile::fake()->image('profile.jpg'),
            'extension' => 'jpg',
            'size' => rand(10, 150),
        ];
    }
}
