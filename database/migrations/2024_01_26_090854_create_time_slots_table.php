<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id(); 
            $table->boolean('is_set'); 
            $table->timestamp('time'); 
            $table->foreignId('course_id')->nullable()->default(null)->constrained();
            $table->timestamps(); 

            // Additional columns can be added as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
