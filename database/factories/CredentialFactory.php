<?php

namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Http\Models\Credential;
use Transave\ScolaCvManagement\Http\Models\CV;


class CredentialFactory extends Factory
{
    protected $model = Credential::class;

    public function definition()
    {
        return [
            'cv_id' => CV::factory(),
            'slug' => $this->faker->slug,
            'file' => UploadedFile::fake()->image('profile.jpg'),
            'extension' => 'jpg',
            'size' => rand(10, 150),
        ];
    }
}
