<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class MedicalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = MedicalReport::latest()->paginate(10);
        $totalReports = MedicalReport::count();
        $reportsThisMonth = MedicalReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $reportsToday = MedicalReport::whereDate('created_at', today())->count();
        
        return view('reports.index', compact('reports', 'totalReports', 'reportsThisMonth', 'reportsToday'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Optional fields
            'tgl_periksa' => 'nullable|date',
            'pasien' => 'nullable|string|max:255',
            'dokter_pengirim' => 'nullable|string|max:255',
            'jenis_pemeriksaan' => 'nullable|string|max:255',
            'no_foto' => 'nullable|string|max:255',
            'no_rm' => 'nullable|string|max:255',
            'no_reg' => 'nullable|string|max:255',
            'kel' => 'nullable|string|max:255',
            'kamar_klinik' => 'nullable|string|max:255',
            
            // Required fields
            'hasil_pemeriksaan' => 'required|string',
            'dokter_pemeriksa' => 'required|string|max:255',
            'nama_terang' => 'required|string|max:255',
            'signature' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle signature upload
        if ($request->hasFile('signature')) {
            $validated['signature_path'] = $request->file('signature')->store('uploads/signatures', 'public');
        }

        $report = MedicalReport::create($validated);

        return redirect()->route('reports.show', $report)->with('success', 'Laporan medis berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalReport $report)
    {
        return view('reports.show', ['medicalReport' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalReport $report)
    {
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalReport $report)
    {
        $validated = $request->validate([
            'hasil_pemeriksaan' => 'required|string',
            'dokter_pemeriksa' => 'required|string|max:255',
            'nama_terang' => 'required|string|max:255',
            'tgl_periksa' => 'nullable|date',
            'pasien' => 'nullable|string|max:255',
            'dokter_pengirim' => 'nullable|string|max:255',
            'jenis_pemeriksaan' => 'nullable|string|max:255',
            'no_foto' => 'nullable|string|max:255',
            'no_rm' => 'nullable|string|max:255',
            'no_reg' => 'nullable|string|max:255',
            'kel' => 'nullable|string|max:255',
            'kamar_klinik' => 'nullable|string|max:255',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle signature upload
        if ($request->hasFile('signature')) {
            // Delete old signature if exists
            if ($report->signature_path) {
                Storage::disk('public')->delete($report->signature_path);
            }
            $validated['signature_path'] = $request->file('signature')->store('uploads/signatures', 'public');
        }

        $report->update($validated);

        return redirect()->route('reports.show', $report)->with('success', 'Laporan medis berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalReport $report)
    {
        // Delete uploaded files if they exist
        if ($report->signature_path && Storage::disk('public')->exists($report->signature_path)) {
            Storage::disk('public')->delete($report->signature_path);
        }

        $report->delete();

        // Auto-reorder IDs after deletion
        $this->reorderIds();

        return redirect()->route('reports.index')->with('success', 'Laporan medis berhasil dihapus dan ID diurutkan ulang!');
    }

    /**
     * Reorder IDs to be sequential starting from 1
     */
    private function reorderIds()
    {
        try {
            // Get all records ordered by created_at to maintain chronological order
            $reports = MedicalReport::orderBy('created_at')->get();
            
            if ($reports->isEmpty()) {
                // If no records, just reset auto increment to 1
                DB::statement('ALTER TABLE medical_reports AUTO_INCREMENT = 1');
                return;
            }
            
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            // Backup data without IDs
            $backupData = [];
            foreach ($reports as $report) {
                $reportArray = $report->toArray();
                unset($reportArray['id']); // Remove ID
                $backupData[] = $reportArray;
            }
            
            // Truncate table (resets auto increment)
            DB::statement('TRUNCATE TABLE medical_reports');
            
            // Explicitly reset auto increment to 1
            DB::statement('ALTER TABLE medical_reports AUTO_INCREMENT = 1');
            
            // Insert back with new sequential IDs
            foreach ($backupData as $data) {
                MedicalReport::create($data);
            }
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
        } catch (\Exception $e) {
            // Re-enable foreign key checks if error occurred
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            \Log::error('ID Reordering failed: ' . $e->getMessage());
        }
    }

    /**
     * Generate PDF for the specified resource.
     */
    public function generatePdf(MedicalReport $report)
    {
        // Check if record exists
        if (!$report->exists) {
            return redirect()->route('reports.index')->with('error', 'Laporan medis tidak ditemukan!');
        }
        
        $pdf = Pdf::loadView('reports.pdf', ['medicalReport' => $report]);
        
        // Generate filename with date and time
        $filename = 'laporan-medis-' . 
                   ($report->pasien ? str_replace(' ', '-', $report->pasien) : 'report') . 
                   '-' . now()->format('d-m-Y_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }
}
