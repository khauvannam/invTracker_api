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
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('activity_type');
            $table->foreignId('item_id')->nullable()->constrained('items')->onDelete('cascade'); // Assuming there's an 'items' table
            $table->foreignId('folder_id')->nullable()->constrained('folders')->onDelete('cascade'); // Assuming there's a 'folders' table            $table->timestamps();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_histories');
    }
};