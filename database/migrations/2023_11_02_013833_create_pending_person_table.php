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
            $table->string('name_of_record');
            $table->string('job_title')->nullable();
            $table->string('email', 100);
            $table->string('alias_email',100)->nullable();
            $table->string('phone', 14)->nullable();
            $table->string('location', 100);
            $table->string('fax', 14)->nullable();
            $table->string('website', 200)->nullable();
            $table->boolean('publishable');
            $table->dateTime('lastApprovedAt')->nullable();;
            $table->unsignedBigInteger('lastApprovedBy')->nullable();;
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
