<?php
// Simple script untuk reset auto increment medical_reports

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "🔄 Memulai reset ID medical_reports...\n";
    
    // Get current records
    $reports = DB::table('medical_reports')->orderBy('created_at')->get();
    $totalRecords = count($reports);
    
    if ($totalRecords == 0) {
        echo "ℹ️  Tidak ada data untuk di-reset.\n";
        exit;
    }
    
    echo "📊 Ditemukan {$totalRecords} records\n";
    
    // Disable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    
    // Backup data
    $backupData = [];
    foreach ($reports as $report) {
        $reportArray = (array) $report;
        unset($reportArray['id']); // Remove ID
        $backupData[] = $reportArray;
    }
    
    // Truncate table (resets auto increment)
    DB::statement('TRUNCATE TABLE medical_reports');
    echo "🗑️  Table di-truncate, auto increment reset ke 1\n";
    
    // Insert back with new sequential IDs
    foreach ($backupData as $index => $data) {
        DB::table('medical_reports')->insert($data);
        $newId = $index + 1;
        $pasienName = $data['pasien'] ?? 'Tidak ada nama';
        echo "✅ ID baru: {$newId} - Pasien: {$pasienName}\n";
    }
    
    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
    
    echo "🎉 Berhasil! ID sekarang urut dari 1 sampai {$totalRecords}\n";
    echo "📋 Cek di: http://127.0.0.1:8000/reports\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1');
}
