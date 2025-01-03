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
        Schema::create('relationship_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained()->onDelete('cascade'); // Khóa ngoại tới bảng tags
            // $table->foreignId('item_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->foreignId('folder_id')->nullable()->constrained()->onDelete('cascade'); // Khóa ngoại tới bảng folders
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationship_tag');
    }
};
