<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('sales', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sold_by')->constrained('users')->restrictOnDelete();
            $table->unsignedInteger('quantity'); $table->decimal('total_price', 10, 2);
            $table->timestamps(); $table->index('created_at');
        });
    }
    public function down(): void { Schema::dropIfExists('sales'); }
};
