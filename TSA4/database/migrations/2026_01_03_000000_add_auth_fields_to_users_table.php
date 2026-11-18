<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users',function(Blueprint $table):void{
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->unique('email');
        });
        Schema::create('password_reset_tokens',function(Blueprint $table):void{
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::table('users',function(Blueprint $table):void{
            $table->dropUnique(['email']);
            $table->dropColumn(['password','email_verified_at','remember_token']);
        });
    }
};
