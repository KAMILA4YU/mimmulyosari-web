<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berkas Pendaftar PPDB</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        h3 {
            text-align: center;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
        }

        .no-border td {
            border: none;
            padding: 4px;
        }

        .center {
            text-align: center;
        }

        .ket {
            height: 28px;
        }

        .catatan {
            font-size: 11px;
            margin-top: 6px;
        }
    </style>
</head>
<body>

<h3>BERKAS PENDAFTAR PPDB</h3>

<!-- IDENTITAS SISWA -->
<table class="no-border">
    <tr>
        <td width="30%">Nama Lengkap</td>
        <td>: {{ $data->nama_lengkap }}</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>: {{ $data->nik }}</td>
    </tr>
    <tr>
        <td>Status Pendaftaran</td>
        <td>: {{ ucfirst($data->status) }}</td>
    </tr>
</table>

<br>

<!-- TABEL CEK BERKAS -->
<table>
    <tr>
        <th width="6%">No</th>
        <th>Nama Berkas</th>
        <th width="34%">Keterangan</th>
    </tr>

    <tr>
        <td class="center">1</td>
        <td>FC Akta Kelahiran</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>

    <tr>
        <td class="center">2</td>
        <td>FC Kartu Keluarga</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>

    <tr>
        <td class="center">3</td>
        <td>Pas Foto 3&times;4 • Seragam TK/RA • Latar merah</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>

    <tr>
        <td class="center">4</td>
        <td>FC Ijazah TK</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>

    <tr>
        <td class="center">5</td>
        <td>Piagam/Sertifikat Prestasi [Jika Ada]</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>

    <tr>
        <td class="center">6</td>
        <td>FC Kartu Sosial [Jika Ada]</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>

    @if($data->status_siswa === 'pindahan')
    <tr>
        <td class="center">7</td>
        <td>Surat Pindahan Sekolah</td>
        <td class="ket">
            ☐ Ada &nbsp;&nbsp; ☐ Tidak Ada <br>
            Ket: ________________________
        </td>
    </tr>
    @endif

</table>

<p class="catatan">
    Catatan: Beri tanda centang (✓) pada kolom yang sesuai dan isi keterangan bila diperlukan.
</p>

<br><br>

<!-- TTD -->
<table class="no-border">
    <tr>
        <td width="60%"></td>
        <td>
            Mulyosari, {{ now()->locale('id')->translatedFormat('d F Y') }}<br>
            Panitia PPDB
            <br><br><br>
            (_________________________)
        </td>
    </tr>
</table>

</body>
</html>
