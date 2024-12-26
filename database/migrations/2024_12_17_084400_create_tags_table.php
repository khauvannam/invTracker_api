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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index(); 
            $table->unsignedBigInteger('item_id')->nullable(); 
            $table->unsignedBigInteger('folder_id')->nullable(); 
            $table->timestamps();
        
            // Ràng buộc khóa ngoại
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('set null');

            //index



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
