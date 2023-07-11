<?php

namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Http\Models\Photos;
use Transave\ScolaCvManagement\Http\Models\User;

class PhotosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => config('scolacv.auth_model')::factory(),
             'photo' => UploadedFile::fake()->image('profile.jpg'),
        ];
    }
}
