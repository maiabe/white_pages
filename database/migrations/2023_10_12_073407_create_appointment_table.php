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
        Schema::create('appointment', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('dept_id');
            $table->string('email', 90);
            $table->string('title', 100);
            $table->primary(['person_id', 'dept_id']);
            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('department')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
