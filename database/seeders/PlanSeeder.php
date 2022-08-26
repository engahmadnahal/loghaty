<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Plan::factory(1)->create();
        Plan::create(['name_en' => 'Free Plan',
        'name_ar' => 'الخطة المجانية',
        'sum_month' => 99999,
        'price_usd' => 0.00,
        'price_aed' => 0.00,
        'totale_child_subscrip' => 9999,
        'active' => true]);

        Plan::create(['name_en' => 'Free Plan',
        'name_ar' => 'الخطة شهر',
        'sum_month' => 1,
        'price_usd' => 0.99,
        'price_aed' => 1.55,
        'totale_child_subscrip' => 3,
        'active' => true]);

        Plan::create(['name_en' => 'Free Plan',
        'name_ar' => 'الخطة 12 شهر',
        'sum_month' => 12,
        'price_usd' => 12.99,
        'price_aed' => 24.55,
        'totale_child_subscrip' => 10,
        'active' => true]);
    }
}
