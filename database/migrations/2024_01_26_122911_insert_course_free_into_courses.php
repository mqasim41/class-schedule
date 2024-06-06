<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Add the "Free" course for every user
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('courses')->insert([
                'course_name' => 'Break',
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the "Free" course for every user
        DB::table('courses')->where('course_name', 'Break')->delete();
    }
};
