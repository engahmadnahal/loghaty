<?php

namespace Database\Seeders;

use App\Models\PlanTeacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PlanTeacher::create(['name_en' => 'Free Plan',
        'name_ar' => 'الخطة المجانية',
        'sum_month' => 99999,
        'price_usd' => 0.00,
        'price_aed' => 0.00,
        'max_class' => 2,
        'max_children' => 3,
        'active' => true]);
    }
}
