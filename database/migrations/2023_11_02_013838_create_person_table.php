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
            $table->string('name_of_record');
            $table->string('job_title')->nullable(true);
            $table->string('email', 100);
            $table->string('alias_email',100)->nullable(true);
            $table->string('phone', 14)->nullable(true);
            $table->string('location', 100)->nullable(true);
            $table->string('fax', 14)->nullable()->nullable(true);
            $table->string('website', 200)->nullable(true);
            $table->boolean('publishable')->default(false);
            $table->dateTime('lastApprovedAt')->nullable(true);
            $table->unsignedBigInteger('lastApprovedBy')->default(0);
            $table->boolean('pending')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Person');
    }
};
