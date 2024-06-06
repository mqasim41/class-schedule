<?php

namespace Database\Seeders;
use App\Models\Course;
use Illuminate\Database\Seeder;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('courses')->insert([
                'course_name' => 'Break',
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $breakCourse = Course::where('course_name', 'Break')->first();
        $timeSlots = [];
        $startTime = Carbon::create(2024, 1, 28, 9, 0, 0);
        $endTime = Carbon::create(2024, 1, 28, 17, 0, 0);
        for ($day = 0; $day < 5; $day++) {
            $startTime->addDay()->setHour(9);
            $endTime->addDay();
            
            while ($startTime < $endTime) {
                $timeSlots[] = [
                    'is_set' => true,
                    'time' => $startTime->copy(),
                    'course_id' => $breakCourse->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $startTime->addHour();
            }
        }

        

        Slot::insert($timeSlots);
    }
}
