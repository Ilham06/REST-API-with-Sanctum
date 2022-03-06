<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'course_name' => 'Dasar Pemograman',
                'sks'           => '3',
            ],
            [
                'course_name' => 'Algoritma',
                'sks'           => '3',
            ],
            [
                'course_name' => 'Kalkulus',
                'sks'           => '3',
            ],
            [
                'course_name' => 'Desain Web',
                'sks'           => '2',
            ],
            [
                'course_name' => 'Statistika',
                'sks'           => '2',
            ],
        ];

        Course::insert($courses);
    }
}
