<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        // Delete associated files
        if ($report->logo_path) {
            Storage::disk('public')->delete($report->logo_path);
        }
        if ($report->signature_path) {
            Storage::disk('public')->delete($report->signature_path);
        }

        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Laporan medis berhasil dihapus!');
    }

    /**
     * Generate PDF for the specified resource.
     */
    public function generatePdf(MedicalReport $report)
    {
        $pdf = Pdf::loadView('reports.pdf', ['medicalReport' => $report]);
        return $pdf->download('laporan-medis-' . $report->id . '.pdf');
    }
}
