<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldRelationshipsTable extends Migration
{
    public function up(): void
    {
        Schema::create('custom_field_relationships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_field_id');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('folder_id')->nullable(); 
            $table->text('value')->nullable(); 
            $table->timestamps();

            
            $table->foreign('custom_field_id')->references('id')->on('custom_fields')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_field_relationships');
    }
}
