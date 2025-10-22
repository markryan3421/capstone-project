<?php

use App\Models\Sdg;
use App\Models\Goal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_productivities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sdg::class, 'sdg_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Goal::class, 'goal_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Task::class, 'task_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::Class, 'user_id')->constrained()->cascadeOnDelete(); // ID of staff

            $table->string('subject');
            $table->text('comments')->nullable();
            $table->date('date');
            // $table->time('start_time');
            // $table->time('end_time');
            // $table->integer('time_rendered'); // Duration in minutes

            // $table->string('file_name')->nullable();
            // $table->string('file_size')->nullable();
            // $table->string('file_type')->nullable();
            // $table->string('file_path')->nullable();

            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_productivities');
    }
};
