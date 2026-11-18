<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table): void {
            $table->id();
            $table->string('title', 150);
            $table->string('status', 20)->default('pending');
            $table->date('task_date');
            $table->timestamps();
            $table->index('task_date');
        });
    }
    public function down(): void { Schema::dropIfExists('tasks'); }
};
