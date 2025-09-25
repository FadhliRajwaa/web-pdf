<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Medis - {{ $medicalReport->pasien ?? 'Pasien' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(135deg, #FBF9D1 0%, #E6CFA9 100%);
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(154, 63, 63, 0.1);
            overflow: hidden;
        }
        
        /* Hospital Header */
        .hospital-header {
            background: linear-gradient(135deg, #9A3F3F 0%, #C1856D 100%);
            color: white;
            text-align: center;
            padding: 25px 20px;
            position: relative;
        }
        
        .hospital-header::before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 20px 20px 0 0;
        }
        
        .hospital-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 3px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .hospital-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .hospital-address {
            font-size: 13px;
            opacity: 0.95;
            line-height: 1.4;
        }
        
        /* Report Header */
        .report-header {
            text-align: center;
            padding: 30px 20px 20px;
            background: linear-gradient(135deg, #E6CFA9 0%, #FBF9D1 100%);
        }
        
        .report-title {
            font-size: 28px;
            font-weight: 800;
            color: #9A3F3F;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(154, 63, 63, 0.1);
        }
        
        .report-subtitle {
            font-size: 16px;
            color: #C1856D;
            font-weight: 600;
        }
        
        /* Content */
        .content {
            padding: 30px;
        }
        
        .section {
            margin-bottom: 25px;
            background: linear-gradient(135deg, #FBF9D1 0%, #E6CFA9 100%);
            border-radius: 12px;
            padding: 20px;
            border-left: 5px solid #9A3F3F;
            box-shadow: 0 4px 12px rgba(154, 63, 63, 0.08);
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #9A3F3F;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .section-title::before {
            content: '';
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, #9A3F3F, #C1856D);
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 12px;
        }
        
        .info-row {
            display: flex;
            align-items: center;
            padding: 8px 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #9A3F3F;
            min-width: 140px;
            flex-shrink: 0;
        }
        
        .info-colon {
            margin: 0 8px;
            color: #C1856D;
            font-weight: 600;
        }
        
        .info-value {
            color: #2d3748;
            font-weight: 500;
        }
        
        .content-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            border: 2px solid #E6CFA9;
            line-height: 1.8;
            color: #2d3748;
            box-shadow: 0 4px 12px rgba(154, 63, 63, 0.05);
        }
        
        /* Signature Section */
        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 40px;
            padding: 25px;
            background: linear-gradient(135deg, #E6CFA9 0%, #FBF9D1 100%);
            border-radius: 12px;
            border: 2px solid #C1856D;
        }
        
        .date-location {
            font-size: 14px;
            color: #9A3F3F;
            font-weight: 600;
        }
        
        .signature-box {
            text-align: center;
            min-width: 200px;
        }
        
        .signature-title {
            font-size: 14px;
            color: #9A3F3F;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .signature-image {
            max-width: 150px;
            max-height: 80px;
            object-fit: contain;
            margin: 10px 0;
        }
        
        .signature-space {
            height: 80px;
            border-bottom: 2px solid #C1856D;
            margin: 10px 0;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .doctor-info {
            margin-top: 15px;
        }
        
        .doctor-name {
            font-weight: 700;
            color: #9A3F3F;
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .doctor-title {
            color: #C1856D;
            font-size: 14px;
            font-weight: 600;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #9A3F3F 0%, #C1856D 100%);
            color: white;
            font-size: 12px;
            margin-top: 30px;
            border-radius: 0 0 15px 15px;
        }
        
        /* Modern styling */
        .highlight-box {
            background: linear-gradient(135deg, #9A3F3F 0%, #C1856D 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 15px 0;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 4px 12px rgba(154, 63, 63, 0.2);
        }
        
        .empty-field {
            color: #9CA3AF;
            font-style: italic;
        }
        
        @media print {
            body { 
                background: white; 
                padding: 0;
            }
            .container {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hospital Header -->
        <div class="hospital-header">
            <div class="hospital-name">Yayasan Kristen untuk Kesehatan Umum (YAKKUM)</div>
            <div class="hospital-title">RS MARDI WALUYO</div>
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

        <div class="content">
            <!-- Data Pemeriksaan -->
            @if($medicalReport->tgl_periksa || $medicalReport->pasien || $medicalReport->dokter_pengirim || $medicalReport->jenis_pemeriksaan || $medicalReport->no_foto || $medicalReport->no_rm || $medicalReport->no_reg || $medicalReport->kel || $medicalReport->kamar_klinik)
            <div class="section">
                <div class="section-title">Data Pemeriksaan</div>
                <div class="info-grid">
                    @if($medicalReport->tgl_periksa)
                        <div class="info-row">
                            <div class="info-label">Tanggal Periksa</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->tgl_periksa->format('d F Y') }}</div>
                        </div>
                    @endif
                    @if($medicalReport->pasien)
                        <div class="info-row">
                            <div class="info-label">Nama Pasien</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->pasien }}</div>
                        </div>
                    @endif
                    @if($medicalReport->no_rm)
                        <div class="info-row">
                            <div class="info-label">No. Rekam Medis</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->no_rm }}</div>
                        </div>
                    @endif
                    @if($medicalReport->no_reg)
                        <div class="info-row">
                            <div class="info-label">No. Registrasi</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->no_reg }}</div>
                        </div>
                    @endif
                    @if($medicalReport->kel)
                        <div class="info-row">
                            <div class="info-label">Jenis Kelamin</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->kel }}</div>
                        </div>
                    @endif
                    @if($medicalReport->kamar_klinik)
                        <div class="info-row">
                            <div class="info-label">Kamar/Klinik</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->kamar_klinik }}</div>
                        </div>
                    @endif
                    @if($medicalReport->jenis_pemeriksaan)
                        <div class="info-row">
                            <div class="info-label">Jenis Pemeriksaan</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->jenis_pemeriksaan }}</div>
                        </div>
                    @endif
                    @if($medicalReport->no_foto)
                        <div class="info-row">
                            <div class="info-label">No. Foto</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->no_foto }}</div>
                        </div>
                    @endif
                    @if($medicalReport->dokter_pengirim)
                        <div class="info-row">
                            <div class="info-label">Dokter Pengirim</div>
                            <div class="info-colon">:</div>
                            <div class="info-value">{{ $medicalReport->dokter_pengirim }}</div>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Hasil Pemeriksaan -->
            <div class="section">
                <div class="section-title">Hasil Pemeriksaan</div>
                <div class="content-box">
                    {!! nl2br(e($medicalReport->hasil_pemeriksaan)) !!}
                </div>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="date-location">
                    Metro, {{ $medicalReport->created_at ? $medicalReport->created_at->format('d F Y') : date('d F Y') }}
                </div>
                <div class="signature-box">
                    <div class="signature-title">Dokter Pemeriksa,</div>
                    
                    @if($medicalReport->signature_path)
                        <img src="{{ public_path('storage/' . $medicalReport->signature_path) }}" alt="Tanda Tangan" class="signature-image">
                    @else
                        <div class="signature-space"></div>
                    @endif
                    
                    <div class="doctor-info">
                        <div class="doctor-name">{{ $medicalReport->dokter_pemeriksa }}</div>
                        <div class="doctor-title">{{ $medicalReport->nama_terang }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Laporan ini dibuat secara elektronik pada {{ $medicalReport->created_at ? $medicalReport->created_at->format('d F Y H:i') : date('d F Y H:i') }} WIB
        </div>
    </div>
</body>
</html>
