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
        Schema::create('ContactAppointment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->unique();
            $table->unsignedBigInteger('dept_id')->unique();
            $table->dateTime('createdAt');
            $table->unsignedBigInteger('createdBy');
            $table->foreign('person_id')->references('id')->on('Person')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('Department')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_appointment');
    }
};
