<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Rencana Studi - {{ $krs->mahasiswa->nama ?? '-' }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            margin: 30px;
        }

        .kop-table {
            width: 100%;
            margin-bottom: 5px;
        }

        .kop-logo {
            width: 85px;
            height: 85px;
        }

        .kop-title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
        }

        .kop-subtitle {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
        }

        .kop-info {
            font-size: 11px;
            text-align: center;
            margin-top: 3px;
        }

        .line-bold {
            border-bottom: 2px solid #000;
            margin-top: 4px;
        }

        .line-thin {
            border-bottom: 0.8px solid #000;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 6px;
            font-size: 12px;
            border: 1px solid #000;
        }

        .no-border td {
            border: none;
            padding: 4px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .ttd-block {
            width: 100%;
            margin-top: 50px;
        }

        .ttd-cell {
            width: 33%;
            text-align: center;
        }

        .ttd-date {
            text-align: right;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

   {{-- KOP SURAT --}}
<table class="kop-table" style="text-align: center;">
    <tr>
        <td style="width: 20%; border: none; text-align: right;">
            <img src="{{ public_path('images/logo.png') }}" class="kop-logo" alt="Logo">
        </td>
        <td style="width: 60%; border: none;">
            <div class="kop-title">KARTU RENCANA STUDI (KRS)</div>
            <div class="kop-subtitle">POLITEKNIK INDONESIA BANJARMASIN</div>
            <div class="kop-info">
                Alamat: Jl. Brigjend. H. Hasan Basri / Kayu Tangi No. 4D RT. 14 (+50 m sebelum RS. Ansari Saleh) Telp. (0511) 3307631 Fax. (0511) 3307632 Banjarmasin
            </div>
        </td>
        <td style="width: 20%; border: none;"></td>
    </tr>
</table>


    <div class="line-bold"></div>
    <div class="line-thin"></div>

{{-- BIODATA MAHASISWA --}}
<table class="no-border" style="margin-top: 10px;">
    <tr>
        <td style="width: 20%"><strong>Nama</strong></td>
        <td style="width: 30%">: {{ $krs->mahasiswa->nama ?? '-' }}</td>
        <td style="width: 20%"><strong>Semester</strong></td>
        <td style="width: 30%">: {{ $krs->mahasiswa->semester ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>NIM / No. Reg</strong></td>
        <td>: {{ $krs->mahasiswa->nim ?? '-' }}</td>
        <td><strong>P.A</strong></td>
        <td>: {{ $krs->mahasiswa->dosenWali->nama ?? '-' }}</td>
    </tr>
</table>


    {{-- TABEL MATA KULIAH --}}
    <table style="margin-top: 20px;">
        <thead>
            <tr class="text-center">
                <th style="width: 5%">No</th>
                <th style="width: 20%">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th style="width: 10%">SKS</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSks = 0; @endphp
            @foreach ($krs->details as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">>{{ $detail->mataKuliah->kode_mk ?? '-' }}</td>
                    <td class="text-center">>{{ $detail->mataKuliah->nama ?? '-' }}</td>
                    <td class="text-center">{{ $detail->mataKuliah->sks ?? '0' }}</td>
                </tr>
                @php $totalSks += $detail->mataKuliah->sks ?? 0; @endphp
            @endforeach
            <tr>
                <td colspan="3" class="text-end" style="text-align: center;"><strong>JUMLAH SKS</strong></td>
                <td class="text-center"><strong>{{ $totalSks }}</strong></td>
            </tr>
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="ttd-date" style="margin-top: 2rem;">Banjarmasin, {{ now()->translatedFormat('d F Y') }}</div>

    <table class="ttd-block">
        <tr>
            <td class="ttd-cell">
                Mahasiswa<br><br><br><br><br><br><br>
                <strong>{{ $krs->mahasiswa->nama ?? '-' }}</strong>
            </td>
            <td class="ttd-cell">
                Pembimbing Akademik (PA)<br><br><br><br><br><br><br>
                <strong>{{ $krs->mahasiswa->dosenWali->nama ?? '-' }}</strong>
            </td>
            <td class="ttd-cell">
                Direktur<br><br><br><br><br><br><br>
                <strong>Yerika Elok N., S.Si.T., M.Keb</strong>
            </td>
        </tr>
    </table>

    {{-- KETERANGAN --}}
    <p style="margin-top: 30px; font-size: 11px;">
        <strong>Keterangan:</strong><br>
        1. Administrasi Akademik (Merah)<br>
        2. Pembimbing Akademik (Hijau)<br>
        3. Mahasiswa (Putih)<br><br>

        <strong>Catatan:</strong><br>
        Mahasiswa yang tidak menyerahkan KRS, maka tidak masuk dalam Absen dan KHS (nilai kosong)
    </p>

</body>
</html>
