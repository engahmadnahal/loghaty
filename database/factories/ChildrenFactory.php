<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Children>
 */
class ChildrenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'date_of_birth' => '2007-08-26',
            'status' => 'active',
            'father_id' => mt_rand(1,5),
            'country_id' => mt_rand(1,3),
            'semester_id' => mt_rand(1,5),
        ];
    }
}
