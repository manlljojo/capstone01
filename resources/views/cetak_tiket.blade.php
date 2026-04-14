<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Elektronik - {{ $peserta->event->nama_event }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Jost', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 50px rgba(0,0,0,0.1);
            position: relative;
        }
        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px dashed #eee;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .logo h1 {
            color: #512da8;
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }
        .ticket-id {
            background: #f0ecf9;
            color: #512da8;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .event-info {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        .event-title h2 {
            margin: 0 0 10px 0;
            font-size: 2rem;
            color: #1a1a2e;
        }
        .event-detail {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #666;
        }
        .event-detail i {
            width: 25px;
            color: #512da8;
        }
        .qr-section {
            text-align: center;
            border-left: 2px solid #eee;
            padding-left: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .qr-mock {
            width: 150px;
            height: 150px;
            background: #333;
            border: 10px solid white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            text-align: center;
        }
        .restriction-box {
            background: #fff9f0;
            border: 2px solid #ffeeba;
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
        }
        .restriction-box h4 {
            margin-top: 0;
            color: #856404;
            display: flex;
            align-items: center;
        }
        .restriction-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .restriction-item {
            font-size: 0.9rem;
            color: #666;
        }
        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #512da8;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(81, 45, 168, 0.4);
            display: flex;
            align-items: center;
            z-index: 100;
        }
        @media print {
            .print-btn { display: none; }
            body { padding: 0; background: white; }
            .container { box-shadow: none; width: 100%; border: 1px solid #eee; }
        }
    </style>
</head>
<body>

    <button class="print-btn" onclick="window.print()">
        <i class="fa fa-print me-2"></i> Cetak Tiket Sekarang
    </button>

    <div class="container">
        <div class="ticket-header">
            <div class="logo">
                <h1>KONSER KITA</h1>
                <p style="margin:0; font-size:0.8rem; color:#999;">E-TICKET OFFICIAL ENTRY</p>
            </div>
            <div class="ticket-id">
                #{{ $peserta->tiket_id }}
            </div>
        </div>

        <div class="event-info">
            <div class="event-title">
                <small style="color: #ff9800; font-weight: bold; text-uppercase; tracking-spacing: 2px;">MUSIK & FESTIVAL</small>
                <h2>{{ $peserta->event->nama_event }}</h2>
                
                <div class="event-detail">
                    <i class="fa fa-user"></i> <span>Pemilik: <strong>{{ $peserta->nama }}</strong></span>
                </div>
                <div class="event-detail">
                    <i class="fa fa-calendar-alt"></i> <span>Tanggal: {{ \Carbon\Carbon::parse($peserta->event->tanggal)->format('d F Y') }}</span>
                </div>
                <div class="event-detail">
                    <i class="fa fa-map-marker-alt"></i> <span>Lokasi: {{ $peserta->event->lokasi }}</span>
                </div>
                <div class="event-detail">
                    <i class="fa fa-clock"></i> <span>Waktu: {{ $peserta->event->jam_operasional }}</span>
                </div>
            </div>
            <div class="qr-section">
                <div class="qr-mock">
                    <i class="fa fa-qrcode fa-5x"></i>
                </div>
                <small class="text-muted">SCAN SAAT MASUK</small>
            </div>
        </div>

        <div class="restriction-box">
            <h4><i class="fa fa-info-circle me-2"></i> INFO PENTING PELAKSANAAN</h4>
            <div class="restriction-grid">
                <div class="restriction-item">
                    <strong>Kapasitas Peserta:</strong><br>
                    Maks. {{ $peserta->event->kapasitas }} Orang
                </div>
                <div class="restriction-item">
                    <strong>Estimasi Durasi:</strong><br>
                    ~{{ $peserta->event->durasi }}
                </div>
                <div class="restriction-item">
                    <strong>Faktor Pembatas:</strong><br>
                    {{ $peserta->event->faktor_pembatas }}
                </div>
                <div class="restriction-item">
                    <strong>Status:</strong><br>
                    <span style="color: #28a745; font-weight: bold;">LUNAS / VALID</span>
                </div>
            </div>
        </div>

        <div style="margin-top: 40px; font-size: 0.8rem; color: #999; border-top: 1px solid #eee; padding-top: 20px;">
            <p><strong>Syarat & Ketentuan:</strong> (1) Tiket ini sah hanya jika status pembayaran lunas. (2) Tunjukkan tiket ini pada petugas di gerbang masuk. (3) Dilarang membawa benda tajam atau obat-obatan terlarang ke dalam venue.</p>
        </div>
    </div>

</body>
</html>
