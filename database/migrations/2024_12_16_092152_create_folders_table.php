<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->text('notes')->nullable(); 
            $table->json('photos')->nullable(); 
            $table->text('qrcode')->nullable(); 
            $table->json('custom_fields')->nullable();
            $table->foreignId('parent_id')->nullable()->index();
            $table->foreignId('inventory_id')->index();
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};
