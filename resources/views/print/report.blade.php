<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan_Surat_{{ $type }}_{{ $date_start . ' s/d ' . $date_end}}</title>
    <style>
        body {
            /* width: 80%; */
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
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

        th {
            text-align: center;
        }

        td {
            vertical-align: top;
            padding: 3px;
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
            border-width: 1px;
        }

    </style>
</head>

<body>
    {!! $kop->content !!}
    <hr>
    <div style="text-align: center; margin: 1rem 0;">
        <h3>Laporan Surat {{ ucfirst($type) }}</h3>
        @if ($data->isEmpty())
        <h1 style="color: red;">Tidak ada data terkait</h1>
        @else
        @if ($total_receiver == 1)
        <h3>{{ $data[0]->receiver->name }}</h3>
        @endif
        @endif
    </div>

    @if (!$data->isEmpty())
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>No Surat</th>
                @if (empty($total_receiver) || $total_receiver > 1)
                    @if (auth()->user()->biro_id == 1)
                        <th>Tujuan Surat</th>
                    @endif
                @endif
                @if (auth()->user()->type_formatted === 'super')
                    <th>Tujuan Surat</th>
                @endif
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tgl Surat</th>
                @if ($type == 'masuk')
                <th>Pengirim</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td style="max-width: 20px; text-align: center;">{{ $loop->iteration }}</td>
                <td style="max-width: 80px; text-align: center;">{{ $item->no }}</td>
                @if (empty($total_receiver) || $total_receiver > 1)
                    @if (auth()->user()->biro_id == 1)
                        <td style="max-width: 80px; text-align: center;">{{ $item->receiver->name }}</td>
                    @endif
                @endif
                {{-- tampilkan nama2 biro saat super --}}
                @if (auth()->user()->type_formatted === 'super')
                    <td style="max-width: 80px; text-align: center;">{{ $item->receiver->name }}</td>
                @endif
                <td style="max-width: 230px;">{{ $item->title }}</td>
                <td style="max-width: 90px; text-align: center;">{{ $item->category->name }}</td>
                <td style="max-width: 55px; text-align: center;">{{ $item->date_formatted }}</td>
                @if ($type == 'masuk')
                <td style="max-width: 140px;">{{ $item->sender }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 3rem; float: right;">
        <p style="margin-bottom: .2rem;">Samarinda, {{ $date }}</p>
        @if ($petugas !== null)
            <p>{{ $petugas->title }}</p>
            <p style="margin-top: 4rem">{{ $petugas->name }}</p>
            @if ($petugas->sub_title !== null && $petugas->sub_title !== "")
                <p>{{ $petugas->sub_title }}</p>
            @endif
            @if ($petugas->nip !== null && $petugas->nip !== "")
                <p>NIP. {{ $petugas->nip }}</p>
            @endif
        @endif
    </div>
    @endif

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>

</html>
