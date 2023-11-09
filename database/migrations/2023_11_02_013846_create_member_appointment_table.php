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
        Schema::create('MemberAppointment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pperson_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('dept_id');
            $table->dateTime('createdAt');
            $table->unsignedBigInteger('createdBy');
            $table->dateTime('approvedAt');
            $table->unsignedBigInteger('approvedBy');
            $table->foreign('pperson_id')->references('id')->on('PendingPerson')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('Person')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('Department')->onDelete('cascade');
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
