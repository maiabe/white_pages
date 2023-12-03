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
        Schema::create('PPerson_Role', function (Blueprint $table) {
            $table->unsignedBigInteger('pperson_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('pperson_id')->references('id')->on('PendingPerson')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('Role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_person_role');
    }
};
