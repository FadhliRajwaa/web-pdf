@extends('layouts.app')

@section('title', 'Daftar Laporan Medis')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="animate-fade-in">
        <!-- Header -->
        <div class="bg-beige shadow-lg rounded-2xl p-4 sm:p-6 lg:p-8 mb-6 hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2 text-maroon">Daftar Laporan Medis</h1>
                    <p class="text-terracotta text-sm sm:text-base">Kelola semua laporan medis dengan mudah dan efisien</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-64">
                        <input type="text" 
                               placeholder="Cari laporan..." 
                               class="w-full pl-10 pr-4 py-3 bg-cream border border-terracotta rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-300 text-maroon placeholder-terracotta/50 text-sm"
                               x-data="{ search: '' }"
                               x-model="search">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('reports.create') }}" 
                       class="bg-maroon hover:bg-terracotta text-cream px-4 sm:px-6 py-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center space-x-2 text-sm whitespace-nowrap">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="hidden sm:inline">Buat Laporan Baru</span>
                        <span class="sm:hidden">Buat Laporan</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-maroon rounded-xl shadow-lg p-4 sm:p-6 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-white/20 mr-3 sm:mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-white">{{ $totalReports }}</h3>
                        <p class="text-white/90 text-sm">Total Laporan</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-terracotta rounded-xl shadow-lg p-4 sm:p-6 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-white/20 mr-3 sm:mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-8 4v6a2 2 0 002 2h4a2 2 0 002-2v-6M8 7a6 6 0 108 0v1H8V7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-white">{{ $reportsThisMonth }}</h3>
                        <p class="text-white/90 text-sm">Bulan Ini</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-beige rounded-xl shadow-lg p-4 sm:p-6 transform hover:scale-105 transition-all duration-200 border border-terracotta">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-terracotta/20 mr-3 sm:mr-4">
                        <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-maroon">{{ $reportsToday }}</h3>
                        <p class="text-terracotta text-sm">Hari Ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports List -->
        @if($reports->count() > 0)
            <div class="bg-beige shadow-lg rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-terracotta/30">
                        <thead class="bg-terracotta/20">
                            <tr>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-medium text-maroon uppercase tracking-wider">Pasien</th>
                                <th class="hidden sm:table-cell px-6 py-4 text-left text-xs font-medium text-maroon uppercase tracking-wider">Dokter</th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-medium text-maroon uppercase tracking-wider">Tanggal</th>
                                <th class="hidden sm:table-cell px-6 py-4 text-left text-xs font-medium text-maroon uppercase tracking-wider">Status</th>
                                <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-medium text-maroon uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-cream divide-y divide-terracotta/20">
                            @foreach($reports as $report)
                                <tr class="hover:bg-beige/30 transition-all duration-300 group">
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                                <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gradient-to-r from-maroon to-terracotta flex items-center justify-center text-cream font-semibold text-sm sm:text-base">
                                                    {{ $report->pasien ? strtoupper(substr($report->pasien, 0, 1)) : 'P' }}
                                                </div>
                                            </div>
                                            <div class="ml-2 sm:ml-4">
                                                <div class="text-xs sm:text-sm font-medium text-gray-900">{{ $report->pasien ?? 'Nama pasien tidak tersedia' }}</div>
                                                <div class="text-xs text-gray-600">{{ $report->jenis_pemeriksaan ?? 'Pemeriksaan umum' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-sm text-maroon">{{ $report->dokter_pemeriksa }}</td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-terracotta">{{ $report->created_at->format('d/m/Y') }}</td>
                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-terracotta/20 text-terracotta">
                                            Selesai
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('reports.show', $report) }}" 
                                               class="inline-flex items-center p-2 bg-maroon/10 text-maroon text-xs font-medium rounded hover:bg-maroon/20 transition-all duration-300" title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('reports.edit', $report) }}" 
                                               class="inline-flex items-center p-2 bg-terracotta/10 text-terracotta text-xs font-medium rounded hover:bg-terracotta/20 transition-all duration-300" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('reports.generate-pdf', $report) }}" 
                                               class="inline-flex items-center p-2 bg-beige/30 text-maroon text-xs font-medium rounded hover:bg-beige/50 transition-all duration-300" title="PDF">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')"
                                                        class="inline-flex items-center p-2 bg-maroon/10 text-maroon text-xs font-medium rounded hover:bg-maroon/20 transition-all duration-300" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($reports->hasPages())
                    <div class="bg-white/80 px-4 py-3 border-t border-gray-200">
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="bg-beige shadow-lg rounded-xl p-8 sm:p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-bold text-maroon">Belum ada laporan</h3>
                <p class="mt-1 text-sm text-terracotta">Mulai dengan membuat laporan medis pertama Anda.</p>
                <div class="mt-6">
                    <a href="{{ route('reports.create') }}" 
                       class="inline-flex items-center px-6 py-3 shadow-lg text-sm font-medium rounded-lg text-cream bg-maroon hover:bg-terracotta transition-all duration-300 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Laporan Baru
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
