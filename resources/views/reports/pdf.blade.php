<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Medis - {{ $medicalReport->pasien ?? 'Tidak diisi' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333333;
            background: #ffffff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Hospital Header */
        .hospital-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #9A3F3F;
        }
        
        .hospital-name {
            font-size: 14px;
            font-weight: 600;
            color: #9A3F3F;
            margin-bottom: 3px;
        }
        
        .hospital-main {
            font-size: 18px;
            font-weight: 700;
            color: #9A3F3F;
            margin-bottom: 8px;
        }
        
        .hospital-address {
            font-size: 11px;
            color: #666666;
            line-height: 1.3;
        }
        
        /* Report Header */
        .report-header {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .report-title {
            font-size: 16px;
            font-weight: 700;
            color: #9A3F3F;
            margin-bottom: 5px;
        }
        
        .report-subtitle {
            font-size: 12px;
            color: #666666;
        }
        
        /* Data Section */
        .data-section {
            margin-bottom: 20px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #9A3F3F;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 1px solid #C1856D;
        }
        
        .data-grid {
            display: table;
            width: 100%;
        }
        
        .data-row {
            display: table-row;
            margin-bottom: 8px;
        }
        
        .data-label {
            display: table-cell;
            width: 30%;
            font-weight: 600;
            color: #333333;
            padding: 4px 0;
            vertical-align: top;
        }
        
        .data-colon {
            display: table-cell;
            width: 5%;
            text-align: center;
            padding: 4px 0;
            color: #333333;
        }
        
        .data-value {
            display: table-cell;
            width: 65%;
            color: #555555;
            padding: 4px 0;
            vertical-align: top;
        }
        
        /* Result Section */
        .result-section {
            margin-bottom: 25px;
        }
        
        .result-content {
            background: #ffffff;
            padding: 15px;
            border: 1px solid #C1856D;
            border-radius: 8px;
            color: #333333;
            line-height: 1.6;
            min-height: 100px;
        }
        
        /* Signature Section */
        .signature-section {
            margin-top: 30px;
            display: table;
            width: 100%;
        }
        
        .signature-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .signature-right {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        
        .signature-date {
            color: #333333;
            margin-bottom: 10px;
        }
        
        .signature-box {
            margin-top: 15px;
        }
        
        .signature-label {
            color: #333333;
            margin-bottom: 40px;
        }
        
        .signature-image {
            max-width: 120px;
            max-height: 60px;
            margin: 10px 0;
        }
        
        .doctor-name {
            font-weight: 600;
            color: #333333;
            margin-bottom: 3px;
            text-decoration: underline;
        }
        
        .doctor-title {
            font-size: 11px;
            color: #666666;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999999;
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
        }
        
        /* Utility Classes */
        .text-center { text-align: center; }
        .font-bold { font-weight: 600; }
        .mb-2 { margin-bottom: 8px; }
        .mb-3 { margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hospital Header -->
        <div class="hospital-header">
            <div class="hospital-name">Yayasan Kristen untuk Kesehatan Umum (YAKKUM)</div>
            <div class="hospital-main">RS MARDI WALUYO</div>
            <div class="hospital-address">
                Jl. Jendral Sudirman No 156 Metro<br>
                Kota Metro 34111<br>
                Telepon (0752) 42512 Fax: (0725) 43053
            </div>
        </div>
        
        <!-- Report Header -->
        <div class="report-header">
            <div class="report-title">LAPORAN MEDIS</div>
            <div class="report-subtitle">Hasil Pemeriksaan Radiologi</div>
        </div>
        
        <!-- Data Pemeriksaan (Optional Fields) -->
        @if($medicalReport->tgl_periksa || $medicalReport->pasien || $medicalReport->dokter_pengirim || $medicalReport->jenis_pemeriksaan || $medicalReport->no_foto || $medicalReport->no_rm || $medicalReport->no_reg || $medicalReport->kel || $medicalReport->kamar_klinik)
        <div class="data-section">
            <div class="section-title">Data Pemeriksaan</div>
            <div class="data-grid">
                @if($medicalReport->tgl_periksa)
                <div class="data-row">
                    <div class="data-label">Tanggal Periksa</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->tgl_periksa ? $medicalReport->tgl_periksa->format('d F Y') : 'Tidak diisi' }}</div>
                </div>
                @endif
                
                @if($medicalReport->pasien)
                <div class="data-row">
                    <div class="data-label">Pasien</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->pasien }}</div>
                </div>
                @endif
                
                @if($medicalReport->dokter_pengirim)
                <div class="data-row">
                    <div class="data-label">Dokter Pengirim</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->dokter_pengirim }}</div>
                </div>
                @endif
                
                @if($medicalReport->jenis_pemeriksaan)
                <div class="data-row">
                    <div class="data-label">Jenis Pemeriksaan</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->jenis_pemeriksaan }}</div>
                </div>
                @endif
                
                @if($medicalReport->no_foto)
                <div class="data-row">
                    <div class="data-label">No Foto</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->no_foto }}</div>
                </div>
                @endif
                
                @if($medicalReport->no_rm)
                <div class="data-row">
                    <div class="data-label">No RM</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->no_rm }}</div>
                </div>
                @endif
                
                @if($medicalReport->no_reg)
                <div class="data-row">
                    <div class="data-label">No REG</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->no_reg }}</div>
                </div>
                @endif
                
                @if($medicalReport->kel)
                <div class="data-row">
                    <div class="data-label">Kelamin</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->kel }}</div>
                </div>
                @endif
                
                @if($medicalReport->kamar_klinik)
                <div class="data-row">
                    <div class="data-label">Kamar/Klinik</div>
                    <div class="data-colon">:</div>
                    <div class="data-value">{{ $medicalReport->kamar_klinik }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Hasil Pemeriksaan (Required) -->
        <div class="result-section">
            <div class="section-title">Hasil Pemeriksaan</div>
            <div class="result-content">
                {!! nl2br(e($medicalReport->hasil_pemeriksaan)) !!}
            </div>
        </div>
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-left">
                <!-- Empty space for layout -->
            </div>
            <div class="signature-right">
                <div class="signature-date">
                    {{ $medicalReport->created_at ? $medicalReport->created_at->format('d F Y') : date('d F Y') }}
                </div>
                <div class="signature-box">
                    <div class="signature-label">Dokter Pemeriksa,</div>
                    
                    @if($medicalReport->signature_path)
                        <img src="{{ public_path('storage/' . $medicalReport->signature_path) }}" alt="Tanda Tangan" class="signature-image">
                    @else
                        <div style="height: 50px; margin: 15px 0;"></div>
                    @endif
                    
                    <div class="doctor-name">{{ $medicalReport->dokter_pemeriksa }}</div>
                    <div class="doctor-title">{{ $medicalReport->nama_terang }}</div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            Laporan ini dibuat secara elektronik pada {{ now()->format('d F Y H:i') }} WIB
        </div>
    </div>
</body>
</html>
