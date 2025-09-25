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
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable();
            $table->string('hospital_name');
            $table->text('hospital_address');
            $table->string('patient_id');
            $table->string('patient_name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->integer('age');
            $table->date('study_date');
            $table->string('modality');
            $table->string('referring_doctor');
            $table->string('title');
            $table->text('description');
            $table->text('suggestion')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('signature_path')->nullable();
            $table->string('doctor_name');
            $table->string('doctor_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_reports');
    }
};
