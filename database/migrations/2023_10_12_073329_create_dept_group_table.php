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
        Schema::create('dept_group', function (Blueprint $table) {
            $table->string('dept_grp', 6)->primary();
            $table->string('dept_grp_name', 60);
            $table->string('campus_code', 6);
            $table->foreign('campus_code')->references('campus_code')->on('campus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dept_group');
    }
};
