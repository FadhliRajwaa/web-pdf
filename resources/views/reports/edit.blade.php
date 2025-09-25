@extends('layouts.app')

@section('title', 'Edit Laporan Medis')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="animate-fade-in">
        <!-- Header -->
        <div class="bg-beige rounded-xl shadow-lg p-4 sm:p-6 mb-6">
            <div class="flex items-center space-x-3">
                <a href="{{ route('reports.show', $report) }}" class="text-terracotta hover:text-maroon transition-colors duration-200">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-maroon">Edit Laporan Medis</h1>
                    <p class="text-terracotta text-sm sm:text-base">{{ $report->pasien ?? 'Laporan Medis' }} | {{ $report->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Form Content -->
            <div class="bg-cream rounded-xl shadow-lg p-4 sm:p-6 lg:p-8 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    
                    <!-- Optional Fields -->
                    <div class="col-span-full">
                        <h2 class="text-base sm:text-lg font-semibold text-maroon mb-4 flex items-center">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 bg-beige rounded-full flex items-center justify-center mr-2 sm:mr-3">
                                <svg class="w-3 h-3 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            Informasi Tambahan (Opsional)
                        </h2>
                    </div>

                    <div class="col-span-1">
                        <label for="tgl_periksa" class="block text-sm font-medium text-maroon mb-2">Tanggal Periksa</label>
                        <input type="date" 
                               id="tgl_periksa" 
                               name="tgl_periksa" 
                               value="{{ old('tgl_periksa', $report->tgl_periksa ? $report->tgl_periksa->format('Y-m-d') : '') }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon">
                        @error('tgl_periksa')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="pasien" class="block text-sm font-medium text-maroon mb-2">Pasien</label>
                        <input type="text" 
                               id="pasien" 
                               name="pasien" 
                               value="{{ old('pasien', $report->pasien) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Nama pasien">
                        @error('pasien')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dokter_pengirim" class="block text-sm font-medium text-maroon mb-2">Dokter Pengirim</label>
                        <input type="text" 
                               id="dokter_pengirim" 
                               name="dokter_pengirim" 
                               value="{{ old('dokter_pengirim', $report->dokter_pengirim) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Nama dokter pengirim">
                        @error('dokter_pengirim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_pemeriksaan" class="block text-sm font-medium text-maroon mb-2">Jenis Pemeriksaan</label>
                        <input type="text" 
                               id="jenis_pemeriksaan" 
                               name="jenis_pemeriksaan" 
                               value="{{ old('jenis_pemeriksaan', $report->jenis_pemeriksaan) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="CT Scan, MRI, X-Ray, dll.">
                        @error('jenis_pemeriksaan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_foto" class="block text-sm font-medium text-maroon mb-2">No Foto</label>
                        <input type="text" 
                               id="no_foto" 
                               name="no_foto" 
                               value="{{ old('no_foto', $report->no_foto) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Nomor foto">
                        @error('no_foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_rm" class="block text-sm font-medium text-maroon mb-2">No RM</label>
                        <input type="text" 
                               id="no_rm" 
                               name="no_rm" 
                               value="{{ old('no_rm', $report->no_rm) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Nomor rekam medis">
                        @error('no_rm')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_reg" class="block text-sm font-medium text-maroon mb-2">No REG</label>
                        <input type="text" 
                               id="no_reg" 
                               name="no_reg" 
                               value="{{ old('no_reg', $report->no_reg) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Nomor registrasi">
                        @error('no_reg')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kel" class="block text-sm font-medium text-maroon mb-2">Kel</label>
                        <input type="text" 
                               id="kel" 
                               name="kel" 
                               value="{{ old('kel', $report->kel) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Kelamin">
                        @error('kel')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kamar_klinik" class="block text-sm font-medium text-maroon mb-2">Kamar/Klinik</label>
                        <input type="text" 
                               id="kamar_klinik" 
                               name="kamar_klinik" 
                               value="{{ old('kamar_klinik', $report->kamar_klinik) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon"
                               placeholder="Kamar atau klinik">
                        @error('kamar_klinik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Required Fields -->
                    <div class="col-span-full mt-6">
                        <h2 class="text-base sm:text-lg font-semibold text-maroon mb-4 flex items-center">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 bg-maroon/20 rounded-full flex items-center justify-center mr-2 sm:mr-3">
                                <svg class="w-3 h-3 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            Informasi Wajib
                        </h2>
                    </div>

                    <div class="col-span-full">
                        <label for="hasil_pemeriksaan" class="block text-sm font-medium text-maroon mb-2">Hasil Pemeriksaan <span class="text-terracotta">*</span></label>
                        <textarea id="hasil_pemeriksaan" 
                                  name="hasil_pemeriksaan" 
                                  rows="4"
                                  class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon @error('hasil_pemeriksaan') border-red-500 @enderror"
                                  placeholder="Masukkan hasil pemeriksaan lengkap..."
                                  required>{{ old('hasil_pemeriksaan', $report->hasil_pemeriksaan) }}</textarea>
                        @error('hasil_pemeriksaan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="dokter_pemeriksa" class="block text-sm font-medium text-maroon mb-2">Dokter Pemeriksa <span class="text-terracotta">*</span></label>
                        <input type="text" 
                               id="dokter_pemeriksa" 
                               name="dokter_pemeriksa" 
                               value="{{ old('dokter_pemeriksa', $report->dokter_pemeriksa) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon @error('dokter_pemeriksa') border-red-500 @enderror"
                               placeholder="Nama dokter pemeriksa"
                               required>
                        @error('dokter_pemeriksa')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="nama_terang" class="block text-sm font-medium text-maroon mb-2">Nama Terang <span class="text-terracotta">*</span></label>
                        <input type="text" 
                               id="nama_terang" 
                               name="nama_terang" 
                               value="{{ old('nama_terang', $report->nama_terang) }}"
                               class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-terracotta/30 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition-all duration-200 bg-cream text-maroon @error('nama_terang') border-red-500 @enderror"
                               placeholder="Nama terang dokter"
                               required>
                        @error('nama_terang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Signature Upload -->
                    <div class="col-span-full mt-4">
                        <label for="signature" class="block text-sm font-medium text-maroon mb-2">Upload Tanda Tangan Baru (Opsional)</label>
                        <div class="mt-1 flex justify-center px-4 sm:px-6 pt-4 sm:pt-5 pb-4 sm:pb-6 border-2 border-terracotta/30 border-dashed rounded-lg hover:border-maroon transition-colors duration-200 bg-beige/20" 
                             x-data="{ fileName: '' }" 
                             @drop.prevent="$refs.signatureInput.files = $event.dataTransfer.files; fileName = $event.dataTransfer.files[0]?.name || ''"
                             @dragover.prevent 
                             @dragenter.prevent>
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-terracotta" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-terracotta">
                                    <label for="signature" class="relative cursor-pointer bg-cream rounded-md px-2 font-medium text-maroon hover:text-terracotta focus-within:outline-none">
                                        <span>Upload tanda tangan baru</span>
                                        <input id="signature" name="signature" type="file" class="sr-only" accept="image/*" 
                                               x-ref="signatureInput" 
                                               @change="fileName = $event.target.files[0]?.name || ''">
                                    </label>
                                    <p class="pl-1 text-terracotta/70">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-terracotta/60">PNG, JPG, JPEG hingga 2MB</p>
                                <p x-show="fileName" x-text="'File: ' + fileName" class="text-xs text-maroon font-medium"></p>
                                @if($report->signature_path)
                                    <p class="text-xs text-maroon mt-2">Tanda tangan saat ini sudah tersimpan</p>
                                @endif
                            </div>
                        </div>
                        @error('signature')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-between items-center mb-8">
                <a href="{{ route('reports.show', $report) }}" 
                   class="w-full sm:w-auto bg-beige hover:bg-terracotta/20 text-maroon px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Batal</span>
                </a>
                
                <button type="submit" 
                        class="w-full sm:w-auto bg-maroon hover:bg-terracotta text-cream px-6 sm:px-8 py-2 sm:py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 hover:shadow-lg flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Update Laporan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    // Alpine.js sudah diload dari layout
})
</script>
@endsection
