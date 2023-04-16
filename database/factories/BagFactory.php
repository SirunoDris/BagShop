<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bag>
 */
class BagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName()." Bag",
            'material' => "Material de ".$this->faker->word(),
            'price' => $this->faker->numberBetween(1,1000),
            'user_id' =>rand(1,10),
        ];
    }
}
