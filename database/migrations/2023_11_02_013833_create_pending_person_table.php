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
        Schema::create('PendingPerson', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('username', 60);
            $table->string('name', 60);
            $table->string('name_of_record')->default('');
            $table->string('job_title')->default('');
            $table->string('email', 100);
            $table->string('alias_email',100)->default('');
            $table->string('phone', 14);
            $table->string('location', 100)->default('');
            $table->string('fax', 14)->default('');
            $table->string('website', 200)->default('');
            $table->boolean('publishable');
            $table->dateTime('lastApprovedAt')->nullable();
            $table->unsignedBigInteger('lastApprovedBy')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_person');
    }
};
