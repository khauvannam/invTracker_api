<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsTable extends Migration
{
    public function up(): void
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('type'); 
            $table->string('placeholder')->nullable(); 
            $table->string('default_value')->nullable(); 
            $table->boolean('applies_to_items')->default(false); 
            $table->boolean('applies_to_folders')->default(false); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
    }
}
