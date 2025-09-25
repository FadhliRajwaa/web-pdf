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
        Schema::table('medical_reports', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn([
                'hospital_name',
                'hospital_address', 
                'patient_id',
                'patient_name',
                'gender',
                'age',
                'study_date',
                'modality',
                'referring_doctor',
                'title',
                'description',
                'suggestion',
                'recommendation',
                'doctor_name',
                'doctor_position',
                'logo_path'
            ]);
            
            // Add new columns based on template
            $table->date('tgl_periksa')->nullable(); // Tanggal Periksa (optional)
            $table->string('pasien')->nullable(); // Pasien (optional)
            $table->string('dokter_pengirim')->nullable(); // Dokter Pengirim (optional)
            $table->string('jenis_pemeriksaan')->nullable(); // Jenis Pemeriksaan (optional)
            $table->string('no_foto')->nullable(); // No Foto (optional)
            $table->string('no_rm')->nullable(); // No RM (optional)
            $table->string('no_reg')->nullable(); // No REG (optional)
            $table->string('kel')->nullable(); // Kel (optional)
            $table->string('kamar_klinik')->nullable(); // Kamar/Klinik (optional)
            
            // Required fields
            $table->text('hasil_pemeriksaan'); // Hasil Pemeriksaan (required)
            $table->string('dokter_pemeriksa'); // Dokter Pemeriksa (required)
            $table->string('nama_terang'); // Nama Terang (required)
            // signature_path already exists, keep it for tanda tangan upload
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_reports', function (Blueprint $table) {
            // Add back old columns
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
            $table->string('doctor_name');
            $table->string('doctor_position');
            $table->string('logo_path')->nullable();
            
            // Drop new columns
            $table->dropColumn([
                'tgl_periksa',
                'pasien',
                'dokter_pengirim',
                'jenis_pemeriksaan',
                'no_foto',
                'no_rm',
                'no_reg',
                'kel',
                'kamar_klinik',
                'hasil_pemeriksaan',
                'dokter_pemeriksa',
                'nama_terang'
            ]);
        });
    }
};
