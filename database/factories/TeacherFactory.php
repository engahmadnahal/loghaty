<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'country_id' => mt_rand(1,3),
            'email' =>  $this->faker->email(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'mobile' => '1233423534645',
            'national_id' => '123124235345',
            'status' => 'active',
        ];
    }
}
