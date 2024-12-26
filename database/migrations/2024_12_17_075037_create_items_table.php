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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->unsignedInteger('quantity'); 
            $table->unsignedInteger('alert'); 
            $table->decimal('price', 10, 2); 
            $table->json('images')->nullable();
            $table->text('notes')->nullable(); 
            $table->unsignedBigInteger('folder_id');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
