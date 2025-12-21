<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Pendaftar PPDB</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 10px;
        }

        h3 {
            text-align: center;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }

        th {
            background-color: #eee;
            text-align: center;
        }

        table.ttd {
            border: none;
        }

        table.ttd td {
            border: none !important;
        }

        table.ttd .kosong {
            width: 65%;
        }

        table.ttd .isi-ttd {
            width: 35%;
        }

    </style>
</head>
<body>

<h3>REKAP DATA PENDAFTAR PPDB</h3>

@php
    \Carbon\Carbon::setLocale('id');
@endphp

<table>
    <thead>
        <tr>
            <th width="4%">No</th>
            <th width="16%">Nama Lengkap</th>
            <th width="8%">JK</th>
            <th width="16%">Tempat, Tanggal Lahir</th>
            <th width="18%">Orang Tua</th>
            <th>Alamat Lengkap</th>
            <th width="8%">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendaftar as $i => $data)
        <tr>
            <td align="center">{{ $i + 1 }}</td>
            <td>{{ $data->nama_lengkap }}</td>
            <td align="center">{{ $data->jenis_kelamin }}</td>
            <td>
                {{ $data->tempat_lahir }},
                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
            </td>
            <td>
                Ayah : {{ $data->nama_ayah }} <br>
                Ibu  : {{ $data->nama_ibu }}
            </td>
            <td>{{ $data->alamat }}</td>
            <td align="center">{{ ucfirst($data->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<table class="ttd">
    <tr>
        <td class="kosong"></td>
        <td class="isi-ttd">
            Mulyosari, {{ now()->translatedFormat('d F Y') }}<br>
            Panitia PPDB
            <br><br><br>
            (__________________)
        </td>
    </tr>
</table>

</body>
</html>
