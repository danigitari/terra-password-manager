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
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('organization');
            $table->string('notes');
            $table->string('password');
            $table->string('department')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credentials');
    }
};
