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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('short_url')->nullable(); 
            $table->string('title')->nullable(); 
            $table->integer('is_draft')->default(0);
            $table->text('task_body')->nullable(); 
            $table->string('image')->nullable();
            $table->string('status')->nullable(); 
            $table->date('due_date')->nullable(); 


            $table->bigInteger('created_by')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
