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
        Schema::create('item_relationship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id'); 
            $table->unsignedBigInteger('tag_id');    
            $table->timestamps();
            $table->unique(['item_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_relationship');
    }
};
