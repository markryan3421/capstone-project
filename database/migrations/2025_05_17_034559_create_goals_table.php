<?php

use App\Models\Sdg;
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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'project_manager_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Sdg::class, 'sdg_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('pending'); // pending/in-progress/completed
            $table->string('type'); // long/short term
            $table->decimal('compliance_percentage', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
