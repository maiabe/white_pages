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
        Schema::create('Person', function (Blueprint $table) {
            $table->id();
            $table->string('username', 60);
            $table->string('name', 60);
            $table->string('email', 100);
            $table->string('phone', 14);
            $table->string('location', 100);
            $table->string('fax', 14);
            $table->string('website', 200);
            $table->boolean('publishable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person');
    }
};
