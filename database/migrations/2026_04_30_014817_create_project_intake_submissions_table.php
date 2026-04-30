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
        Schema::create('project_intake_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 60);
            $table->text('project_summary');
            $table->string('locale', 5)->default('es');
            $table->json('selected_modules');
            $table->unsignedSmallInteger('estimate_score');
            $table->string('estimate_size', 4);
            $table->string('budget_tier', 12)->nullable();
            $table->timestamps();

            $table->index(['locale', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_intake_submissions');
    }
};
