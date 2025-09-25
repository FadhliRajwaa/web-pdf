<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetAutoIncrement extends Command
{
    protected $signature = 'medical-reports:reset-ids';
    
    protected $description = 'Reset auto increment IDs untuk medical reports agar urut dari 1';

    public function handle()
    {
        try {
            // Get all records ordered by current ID
            $reports = DB::table('medical_reports')->orderBy('id')->get();
            
            if ($reports->isEmpty()) {
                $this->info('Tidak ada data medical reports.');
                return 0;
            }
            
            $this->info('Memulai reset ID...');
            
            // Temporarily disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Create temporary table with new sequential IDs
            DB::statement('CREATE TEMPORARY TABLE temp_medical_reports AS SELECT * FROM medical_reports ORDER BY id');
            
            // Truncate original table (this resets auto increment)
            DB::statement('TRUNCATE TABLE medical_reports');
            
            // Insert data back without ID (auto increment will start from 1)
            $counter = 1;
            foreach ($reports as $report) {
                $reportArray = (array) $report;
                unset($reportArray['id']); // Remove old ID
                
                DB::table('medical_reports')->insert($reportArray);
                
                $this->info("Reset ID: {$report->id} → {$counter} (Pasien: {$report->pasien})");
                $counter++;
            }
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            $this->info("✅ Berhasil reset {$reports->count()} records. ID sekarang urut dari 1-{$reports->count()}");
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            
            // Re-enable foreign key checks if error occurred
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            return 1;
        }
    }
}
