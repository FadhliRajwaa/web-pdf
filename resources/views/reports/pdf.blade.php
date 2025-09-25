<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Medis - {{ $medicalReport->pasien ?? 'Laporan Medis' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #9A3F3F;
            margin: 0;
            padding: 25px;
            background: #FBF9D1;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #9A3F3F;
            padding-bottom: 20px;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #FBF9D1 0%, #E6CFA9 100%);
            padding: 25px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 4px rgba(154, 63, 63, 0.1);
        }
        
        .report-title {
            font-size: 22px;
            font-weight: 700;
            text-transform: uppercase;
            color: #9A3F3F;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-shadow: 1px 1px 2px rgba(193, 133, 109, 0.3);
        }
        
        .report-subtitle {
            font-size: 14px;
            color: #C1856D;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 15px;
            font-weight: 600;
            color: #9A3F3F;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #E6CFA9;
            background: linear-gradient(90deg, #E6CFA9 0%, transparent 50%);
            padding-left: 10px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            width: 150px;
            padding: 8px 10px 8px 5px;
            font-weight: 600;
            vertical-align: top;
            color: #9A3F3F;
            border-bottom: 1px solid #E6CFA9;
            background: rgba(230, 207, 169, 0.1);
        }
        
        .info-colon {
            display: table-cell;
            width: 15px;
            padding: 8px 5px;
            vertical-align: top;
            color: #C1856D;
            border-bottom: 1px solid #E6CFA9;
            font-weight: 600;
        }
        
        .info-value {
            display: table-cell;
            padding: 8px 0 8px 10px;
            vertical-align: top;
            color: #9A3F3F;
            border-bottom: 1px solid #E6CFA9;
            font-weight: 500;
        }
        
        .content-box {
            background: linear-gradient(135deg, #FBF9D1 0%, #E6CFA9 10%, #FBF9D1 100%);
            border: 2px solid #C1856D;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            line-height: 1.8;
            box-shadow: 0 3px 6px rgba(193, 133, 109, 0.15);
            color: #9A3F3F;
        }
        
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .date-location {
            flex: 1;
        }
        
        .signature-box {
            flex: 1;
            text-align: center;
            max-width: 200px;
            margin-left: auto;
        }
        
        .signature-image {
            max-height: 60px;
            max-width: 150px;
            margin: 15px 0;
        }
        
        .doctor-info {
            border-top: 2px solid #9A3F3F;
            padding-top: 10px;
            margin-top: 20px;
            background: rgba(230, 207, 169, 0.2);
            padding: 10px;
            border-radius: 4px;
        }
        
        .doctor-name {
            font-weight: 700;
            color: #9A3F3F;
            font-size: 13px;
            text-transform: uppercase;
        }
        
        .doctor-title {
            font-size: 12px;
            color: #C1856D;
            margin-top: 3px;
            font-weight: 500;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #C1856D;
            border-top: 2px solid #E6CFA9;
            padding-top: 15px;
            background: linear-gradient(90deg, transparent, #E6CFA9, transparent);
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Hospital Header -->
    <div style="text-align: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #9A3F3F;">
        <div style="font-size: 14px; font-weight: 600; color: #9A3F3F; margin-bottom: 3px;">Yayasan Kristen untuk Kesehatan Umum (YAKKUM)</div>
        <div style="font-size: 18px; font-weight: 700; color: #9A3F3F; margin-bottom: 5px;">RS MARDI WALUYO</div>
        <div style="font-size: 12px; color: #C1856D; margin-bottom: 2px;">Jl. Jendral Sudirman No 156 Metro</div>
        <div style="font-size: 12px; color: #C1856D; margin-bottom: 3px;">Kota Metro 34111</div>
        <div style="font-size: 11px; color: #C1856D;">Telepon (0752) 42512 Fax: (0725) 43053</div>
    </div>
    
    <!-- Header -->
    <div class="header">
        <div class="report-title">LAPORAN MEDIS</div>
        <div class="report-subtitle">Hasil Pemeriksaan Radiologi</div>
    </div>

    <!-- Data Pemeriksaan -->
    @if($medicalReport->tgl_periksa || $medicalReport->pasien || $medicalReport->dokter_pengirim || $medicalReport->jenis_pemeriksaan || $medicalReport->no_foto || $medicalReport->no_rm || $medicalReport->no_reg || $medicalReport->kel || $medicalReport->kamar_klinik)
    <div class="section">
        <div class="section-title">Data Pemeriksaan</div>
        <div class="info-grid">
            @if($medicalReport->tgl_periksa)
                <div class="info-row">
                    <div class="info-label">Tanggal Periksa</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $medicalReport->tgl_periksa ? $medicalReport->tgl_periksa->format('d F Y') : 'Tidak diisi' }}</div>
                </div>
            @endif
            @if($medicalReport->pasien)
                <div class="info-row">
                    <div class="info-label">Pasien</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $medicalReport->pasien }}</div>
                </div>
            @endif
            @if($medicalReport->dokter_pengirim)
                <div class="info-row">
                    <div class="info-label">Dokter Pengirim</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $medicalReport->dokter_pengirim }}</div>
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
                    <div class="info-label">No Foto</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $medicalReport->no_foto }}</div>
                </div>
            @endif
            @if($medicalReport->no_rm)
                <div class="info-row">
                    <div class="info-label">No RM</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $medicalReport->no_rm }}</div>
                </div>
            @endif
            @if($medicalReport->no_reg)
                <div class="info-row">
                    <div class="info-label">No REG</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $medicalReport->no_reg }}</div>
                </div>
            @endif
            @if($medicalReport->kel)
                <div class="info-row">
                    <div class="info-label">Kel</div>
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

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="date-location">
            {{ $medicalReport->created_at ? $medicalReport->created_at->format('d F Y') : date('d F Y') }}
        </div>
        <div class="signature-box">
            <div style="margin-bottom: 10px;">Dokter Pemeriksa,</div>
            
            @if($medicalReport->signature_path)
                <img src="{{ public_path('storage/' . $medicalReport->signature_path) }}" alt="Tanda Tangan" class="signature-image">
            @else
                <div style="height: 60px; margin: 15px 0;"></div>
            @endif
            
            <div class="doctor-info">
                <div class="doctor-name">{{ $medicalReport->dokter_pemeriksa }}</div>
                <div class="doctor-title">{{ $medicalReport->nama_terang }}</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Laporan ini dibuat secara elektronik pada {{ $medicalReport->created_at ? $medicalReport->created_at->format('d F Y H:i') : date('d F Y H:i') }} WIB
    </div>
</body>
</html>
