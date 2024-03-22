<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>LAPORAN DAFTAR ARSIP {{ strtoupper($type) }} - {{ $date_start . ' s/d ' . $date_end}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Styles -->
    <style>
        body {
            font-size: 11px;
            color: #000;
            width: 100%;
        }

        .table {
            font-size: 10px;
        }

        .header-wrapper {
            margin: 0 auto;
        }

        .table-bordered,
        .table-bordered td,
        .table-bordered th,
        .table thead th {
            border-color: #000 !important;
            word-wrap: break-word;
            padding: 4px;
            margin: 0;
        }

        .img-header {
            width: 68px;
            display: block;
            margin: 0 auto;
        }

        th {
            text-align: center;
            vertical-align: middle !important;
        }

        td {
            vertical-align: middle !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            line-height: 1.1;
        }

        p {
            margin: 0;
            line-height: 1.2;
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
    @php $is_admin = auth()->user()->isAdmin(); @endphp

    <h5 class="text-center" style="margin: 1rem 0;">
        LAPORAN DAFTAR ARSIP {{ strtoupper($type) }}
        <br>{{ $is_admin ? '' : strtoupper(auth()->user()->biro->name) }}
    </h5>
    <table class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th style="width: 15px;">No</th>
                @if ($is_admin)
                    <th style="width: 80px;">Unit</th>
                @endif
                {{-- <th>No Surat</th> --}}
                <th style="width: 35px;">Kode</th>
                <th style="width: 35px;">Kode<br>Klas</th>
                <th>Uraian</th>
                <th style="width: 55px;">Tgl</th>
                <th style="width: 25px;">Tk.</th>
                <th style="width: 40px;">Jmlh</th>
                <th style="width: 30px;">No.<br>Box</th>
                <th style="width: 35px;">No.<br>Folder</th>
                {{-- <th>Kondisi Arsip</th> --}}
                <th style="width: 70px;">Ket.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $archive)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    @if ($is_admin)
                        <td>{{ $archive->archivable->biro->name }}</td>
                    @endif
                    {{-- <td>{{ $archive->archivable->no }}</td> --}}
                    <td style="text-align: center;">{{ $archive->clasification->code }}</td>
                    <td style="text-align: center;">{{ $archive->clasification->code_clasification }}</td>
                    <td>{{ $archive->archivable->title }}</td>
                    <td>{{ $archive->date_indo_mini}}</td>
                    <td style="text-align: center;">{{ $archive->tk_prk_formatted }}</td>
                    <td style="text-align: center;">{{ $archive->qty == null ? '-' : $archive->qty . ' berkas' }}</td>
                    <td style="text-align: center;">{{ $archive->no_box ?? '-' }}</td>
                    <td style="text-align: center;">{{ $archive->no_folder ?? '-' }}</td>
                    {{-- <td>{{ $archive->condition_formatted }}</td> --}}
                    <td>{{ $archive->note ?? '-' }}</td>
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
