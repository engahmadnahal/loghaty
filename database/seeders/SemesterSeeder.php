<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $teacher = Teacher::where('status','active')->first();
        Semester::create([
            //
            'name_en' => 'Class One',
            'name_ar' => 'الصف الاول',
            'teacher_id' => $teacher->id,
            'status' => 'active',
        ]);

        Semester::create([
            //
            'name_en' => 'Class two',
            'name_ar' => 'الصف الثاني',
            'teacher_id' => $teacher->id,
            'status' => 'active',
        ]);

        Semester::create([
            //
            'name_en' => 'Class Three',
            'name_ar' => 'الصف الثالث',
            'teacher_id' => $teacher->id,
            'status' => 'active',
        ]);

        Semester::create([
            //
            'name_en' => 'Class Foure',
            'name_ar' => 'الصف الرابع',
            'teacher_id' => $teacher->id,
            'status' => 'active',
        ]);

        Semester::create([
            //
            'name_en' => 'Class Five',
            'name_ar' => 'الصف الخامس',
            'teacher_id' => $teacher->id,
            'status' => 'active',
        ]);
    }
}
