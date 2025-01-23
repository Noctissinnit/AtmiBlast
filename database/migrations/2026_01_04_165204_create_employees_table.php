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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nis')->nullable(); // NIS (unique identifier for employees)
            $table->string('name')->nullable(); // NIS (unique identifier for employees)
            $table->string('email')->nullable(); // NIS (unique identifier for employees)
            $table->foreignId('userid')->nullable() // Foreign key to the users table
                ->constrained('users')
                ->cascadeOnDelete(); // Optional: Cascade on delete
            $table->foreignId('division_id') // Foreign key to the divisions table
                ->constrained('divisions')
                ->cascadeOnDelete(); 
            $table->foreignId('unit_karya_id')->nullable() // Foreign key to the divisions table
                ->constrained('unit_karyas')
                ->cascadeOnDelete();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
