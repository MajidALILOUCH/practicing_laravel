<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 teachers with profiles
        $teachers = User::factory()
            ->count(5)
            ->teacher()
            ->has(Profile::factory())
            ->create();

        // Create 20 students with profiles
        $students = User::factory()
            ->count(20)
            ->student()
            ->has(Profile::factory())
            ->create();

        // Create 15 courses (3 per teacher)
        $courses = [];
        foreach ($teachers as $teacher) {
            $teacherCourses = Course::factory()
                ->count(3)
                ->create([
                    'teacher_id' => $teacher->id
                ]);

            $courses = array_merge($courses, $teacherCourses->all());
        }

        // Enroll students in random courses
        foreach ($students as $student) {
            // Each student enrolls in 1-5 random courses
            $enrollmentCount = rand(1, 5);
            $randomCourses = collect($courses)->random($enrollmentCount);

            foreach ($randomCourses as $course) {
                $student->enrolledCourses()->attach($course->id, [
                    'status' => fake()->randomElement(['enrolled', 'completed', 'dropped']),
                    'progress' => fake()->numberBetween(0, 100)
                ]);

                // 50% chance to add a comment to the course
                if (fake()->boolean(50)) {
                    Comment::factory()->create([
                        'user_id' => $student->id,
                        'commentable_id' => $course->id,
                        'commentable_type' => Course::class
                    ]);
                }
            }
        }

        // Create an admin user for testing
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'teacher',
        ]);

        // Create a test student
        User::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'role' => 'student',
        ]);
    }
}
