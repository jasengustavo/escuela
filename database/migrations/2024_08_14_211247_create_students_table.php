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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('tutor_id')->references('id')->on('tutors');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('sex');
            $table->date('dateOfBirday');
            $table->integer('age');
            $table->string('address');
            $table->text('medicalInfo')->nullable();
            $table->boolean('status')->default(true);
            $table->string('emergencyConcatName')->nullable();
            $table->string('emergencyConcatPhone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
