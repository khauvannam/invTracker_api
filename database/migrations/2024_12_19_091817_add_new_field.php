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
        Schema::create('add_new_field', function (Blueprint $table) {
            $table->Serial_Number();
            $table->decimal('Model/Part_Number'); 
            $table->unsignedInteger('quantity'); 
            $table->unsignedInteger('Purchase_Date'); 
            $table->json('Expiry Date')->nullable();
            $table->text('Size')->nullable(); 
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
