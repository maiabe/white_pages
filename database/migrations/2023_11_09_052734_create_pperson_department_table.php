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
        Schema::create('pperson_department', function (Blueprint $table) {
            $table->unsignedBigInteger('pperson_id');
            $table->unsignedBigInteger('dept_id');
            $table->foreign('pperson_id')->references('id')->on('PendingPerson')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('Department')-> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pperson_department');
    }
};
