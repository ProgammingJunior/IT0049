<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table): void {
            $table->id(); $table->string('name', 100); $table->decimal('price', 10, 2);
            $table->unsignedInteger('stock_quantity')->default(0); $table->string('image')->nullable();
            $table->boolean('is_archived')->default(false); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
