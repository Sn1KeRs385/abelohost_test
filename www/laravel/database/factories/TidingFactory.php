<?php

namespace Database\Factories;

use App\Models\Tiding;
use Illuminate\Database\Eloquent\Factories\Factory;

class TidingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tiding::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
            'text' => $this->faker->text(2000),
        ];
    }
}
