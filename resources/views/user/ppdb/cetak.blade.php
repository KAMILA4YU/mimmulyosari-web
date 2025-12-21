<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 18px;
        }
        h2 {
            text-align: center;
            margin-top: 0;
            font-size: 14px;
            font-weight: normal;
        }
        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            width: 35%;
        }
        .section-title {
            background-color: #ddd;
            font-weight: bold;
            text-align: left;
        }
        
        .qr-cell {
            text-align: center;
            vertical-align: middle;
        }

        .qr-wrapper {
            display: inline-block;
        }

        .qr-wrapper img {
            width: 120px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .qr-text {
            font-size: 10px;
            margin-top: 5px;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <h1>BUKTI PENDAFTARAN PESERTA DIDIK BARU</h1>
    <h2>MI Muhammadiyah Mulyosari</h2>
    <p class="subtitle">
        Tahun Ajaran 2025 / 2026
    </p>

    <!-- A. IDENTITAS CALON SISWA -->
    <table>
        <tr>
            <th colspan="2" class="section-title">A. IDENTITAS CALON SISWA</th>
        </tr>
        <tr>
            <th>Kode Pendaftaran</th>
            <td>{{ $ppdb->kode_daftar }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $ppdb->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $ppdb->nik }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $ppdb->tempat_lahir }}, {{ $ppdb->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $ppdb->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Alamat Lengkap</th>
            <td>
                {{ $ppdb->alamat }}<br>
                Desa {{ $ppdb->desa }},
                Kecamatan {{ $ppdb->kecamatan }},
                Kabupaten {{ $ppdb->kabupaten }},
                Provinsi {{ $ppdb->provinsi }}<br>
                Kode Pos {{ $ppdb->kode_pos }}
            </td>
        </tr>
    </table>

    <!-- B. DATA ORANG TUA -->
    <table>
        <tr>
            <th colspan="2" class="section-title">B. DATA ORANG TUA</th>
        </tr>
        <tr>
            <th>Nama Ibu Kandung</th>
            <td>{{ $ppdb->nama_ibu }}</td>
        </tr>
        <tr>
            <th>No. HP Orang Tua</th>
            <td>{{ $ppdb->no_hp_ibu }}</td>
        </tr>
    </table>

    <!-- C. INFORMASI PENDAFTARAN -->
    <table>
        <tr>
            <th colspan="2" class="section-title">C. INFORMASI PENDAFTARAN</th>
        </tr>
        <tr>
            <th>Nama Sekolah</th>
            <td>MI Muhammadiyah Mulyosari</td>
        </tr>
        <tr>
            <th>Tanggal & Jam Pendaftaran</th>
            <td>{{ $ppdb->created_at }}</td>
        </tr>
        <tr>
            <th>Status Pendaftaran</th>
            <td><strong>{{ $ppdb->status }}</strong></td>
        </tr>
    </table>

    <!-- D. VALIDASI -->
    <table>
        <tr>
            <th colspan="2" class="section-title">D. VALIDASI</th>
        </tr>
        <tr>
            <th>QR Code Verifikasi</th>
            <td class="qr-cell">
                <div class="qr-wrapper">
                    <img src="{{ $qrPath }}" alt="QR Code">
                    <div class="qr-text">
                        Scan QR Code untuk verifikasi data pendaftaran
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <p class="footer">
        Dokumen ini dihasilkan secara otomatis oleh sistem PPDB MI Muhammadiyah Mulyosari
        dan dinyatakan sah tanpa tanda tangan basah.
    </p>

</body>
</html>
