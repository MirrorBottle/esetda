<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Jadwal Kegiatan - {{ $date_start . ' s/d ' . $date_end}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Styles -->
    <style>
        body {
            font-size: 12px;
            color: #000;
            width: 100%;
        }

        .table {
            font-size: 11px;
        }

        tr th,
        tr td,
        .rekap p {
            border-color: #000 !important;
            word-wrap: break-word;
        }

        .header-wrapper {
            margin: 0 auto;
        }

        .table-bordered,
        .table-bordered td,
        .table-bordered th,
        .table thead th {
            border-color: #000 !important;
        }

        .img-header {
            width: 68px;
            display: block;
            margin: 0 auto;
        }

        th {
            text-align: center;
        }

        td {
            vertical-align: top;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
        }

        hr {
            border-color: #000;
            border-width: 3px;
        }

    </style>
</head>

<body>
    <table style="width: 100%; margin-bottom: 1rem;">
        <tr>
            <td style="width: 100px;">
                <img src="{{ asset('images/kaltim-logo.png') }}" class="img-header">
            </td>
            <td>
                <div class="text-center" style="margin-left: -6rem">
                    <h6>PEMERINTAH PROVINSI KALIMANTAN TIMUR</h6>
                    <h2>SEKRETARIAT DAERAH</h2>
                    <p>JALAN GAJAH MADA, TELEPON (0541) 733333 Fax.(0541) 737762-742111</p>
                    <p>Home Page: http://kaltimprov.go.id</p>
                    <p>SAMARINDA 75121</p>
                </div>
            </td>
        </tr>
    </table>

    <hr>

    <h4 class="text-center" style="margin: 1rem 0;">LAPORAN JADWAL KEGIATAN</h4>
    <table class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Acara</th>
                <th>Tempat</th>
                <th>Pakaian</th>
                <th>Pendamping</th>
                <th>Disposisi</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $agenda)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $agenda->date_formatted }}</td>
                    <td>{{ $agenda->time_start }} s/d {{ $agenda->time_end }}</td>
                    <td>{{ $agenda->event }}</td>
                    <td>{{ $agenda->place->name }}</td>
                    <td>{{ $agenda->apparel->name }}</td>
                    <td>{{ $agenda->partner_list }}</td>
                    <td>{{ $agenda->disposition->position }}</td>
                    <td>{{ $agenda->status_formatted }}</td>
                    <td>{{ $agenda->description ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="float-right" style="margin-top: 2rem">
        <p>Samarinda, {{ $date_now }}</p>
        <p>{{ $ttd->title }}</p>
        <p style="margin-top: 4rem">{{ $ttd->name }}</p>
    </div>
</body>

</html>
