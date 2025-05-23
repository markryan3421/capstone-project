<?php

use App\Models\Sdg;
use App\Models\Goal;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Goal::class, 'goal_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Sdg::class, 'sdg_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('status')->default('pending'); // pending/in-progress/completed
            $table->string('approval_status')->default('pending'); // pending/approved/rejected
            $table->text('remarks')->nullable();
            // $table->date('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
