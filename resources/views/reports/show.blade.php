@extends('layouts.app')

@section('title', 'Detail Laporan Medis')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="animate-fade-in">
        <!-- Header -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6 mb-8 border border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Laporan Medis</h1>
                        <p class="text-gray-600">{{ $medicalReport->pasien ?? 'Laporan Medis' }} | {{ $medicalReport->created_at ? $medicalReport->created_at->format('d/m/Y H:i') : 'N/A' }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('reports.edit', $medicalReport) }}" 
                       class="bg-terracotta hover:bg-maroon text-cream px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Edit</span>
                    </a>
                    <a href="{{ route('reports.generate-pdf', $medicalReport) }}" 
                       class="bg-maroon hover:bg-terracotta text-cream px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Download PDF</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Data Pemeriksaan (Optional Fields) -->
                @if($medicalReport->tgl_periksa || $medicalReport->pasien || $medicalReport->dokter_pengirim || $medicalReport->jenis_pemeriksaan || $medicalReport->no_foto || $medicalReport->no_rm || $medicalReport->no_reg || $medicalReport->kel || $medicalReport->kamar_klinik)
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Data Pemeriksaan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($medicalReport->tgl_periksa)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Periksa</label>
                                <p class="text-gray-900 font-semibold">{{ $medicalReport->tgl_periksa->format('d F Y') }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->pasien)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pasien</label>
                                <p class="text-gray-900 font-semibold">{{ $medicalReport->pasien }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->dokter_pengirim)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dokter Pengirim</label>
                                <p class="text-gray-900">{{ $medicalReport->dokter_pengirim }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->jenis_pemeriksaan)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pemeriksaan</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $medicalReport->jenis_pemeriksaan }}
                                </span>
                            </div>
                        @endif
                        
                        @if($medicalReport->no_foto)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No Foto</label>
                                <p class="text-gray-900">{{ $medicalReport->no_foto }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->no_rm)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No RM</label>
                                <p class="text-gray-900">{{ $medicalReport->no_rm }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->no_reg)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No REG</label>
                                <p class="text-gray-900">{{ $medicalReport->no_reg }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->kel)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kel</label>
                                <p class="text-gray-900">{{ $medicalReport->kel }}</p>
                            </div>
                        @endif
                        
                        @if($medicalReport->kamar_klinik)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kamar/Klinik</label>
                                <p class="text-gray-900">{{ $medicalReport->kamar_klinik }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Hasil Pemeriksaan -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        Hasil Pemeriksaan
                    </h2>
                    
                    <div class="prose max-w-none">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <p class="text-gray-900 whitespace-pre-line leading-relaxed">{{ $medicalReport->hasil_pemeriksaan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Dokter Info -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        Dokter Pemeriksa
                    </h3>
                    
                    <div class="text-center">
                        @if($medicalReport->signature_path)
                            <div class="mb-4">
                                <img src="{{ Storage::url($medicalReport->signature_path) }}" 
                                     alt="Tanda Tangan Dokter" 
                                     class="mx-auto max-h-24 object-contain">
                            </div>
                        @endif
                        
                        <h4 class="font-semibold text-gray-900 text-lg">{{ $medicalReport->dokter_pemeriksa }}</h4>
                        <p class="text-gray-600 text-sm">{{ $medicalReport->nama_terang }}</p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('reports.generate-pdf', $medicalReport) }}" 
                           class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Download PDF</span>
                        </a>
                        
                        <a href="{{ route('reports.edit', $medicalReport) }}" 
                           class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Edit Laporan</span>
                        </a>
                        
                        <form action="{{ route('reports.destroy', $medicalReport) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span>Hapus Laporan</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="text-gray-900">{{ $medicalReport->created_at ? $medicalReport->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diperbarui:</span>
                            <span class="text-gray-900">{{ $medicalReport->updated_at ? $medicalReport->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
