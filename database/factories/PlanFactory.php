<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
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
            'name_en' => 'Free Plan',
            'name_ar' => 'الخطة المجانية',
            'sum_month' => 99999,
            'price_usd' => 0.00,
            'price_aed' => 0.00,
            'totale_child_subscrip' => 9999,
            'active' => true,
        ];
    }
}
