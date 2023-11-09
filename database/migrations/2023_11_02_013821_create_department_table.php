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
        Schema::create('Department', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campus_id');
            $table->string('group_no', 6);
            $table->string('name', 60);
            $table->string('email', 100);
            $table->string('phone', 14);
            $table->string('location', 60);
            $table->string('fax', 14);
            $table->string('website', 100);
            $table->foreign('campus_id')->references('id')->on('Campus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_department');
    }
};