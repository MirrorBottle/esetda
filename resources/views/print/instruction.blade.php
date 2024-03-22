<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tanda_Terima_{{ $date_start . '_sd_' . $date_end}}</title>
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
            font-size: 11px;
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
        <h3>Tanda Terima Surat</h3>
        @if ($data->isEmpty())
         <h1 style="color: red;">Tidak ada data terkait</h1>
        @endif
    </div>

    @if (!$data->isEmpty())
    <table border="1" class="table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No Surat</th>
                <th>Pengirim</th>
                <th>Judul</th>
                <th>Tanggal Surat</th>
                <th>Arahan</th>
                <th>Tanda Terima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td style="max-width: 20px; text-align: center;">{{ $loop->iteration }}</td>
                <td style="max-width: 80px; text-align: center;">{{ $item->no }}</td>
                <td style="max-width: 140px;">{{ $item->sender }}</td>
                <td style="max-width: 230px;">{{ $item->title }}</td>
                <td style="max-width: 40px; text-align: center;">{{ $item->date_print }}</td>
                <td style="max-width: 100px;">{{ $item->instruction }}</td>
                <td style="max-width: 20px;">&nbsp;</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>

</html>
