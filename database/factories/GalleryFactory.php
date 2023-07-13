<?php

namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Gallery;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cv_id' => CV::factory(),
            'slug' => $this->faker->slug,
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'extension' => 'jpg',
            'size' => rand(100, 200),
        ];
    }
}
