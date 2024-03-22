<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan_SPT_{{ $file_date }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Styles -->
    <style>
        body {
            font-family:Arial, Helvetica, sans-serif;
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
    <h4 class="text-center" style="margin: 0;">REKAPITULASI PERJALANAN DINAS</h4>
    <h4 class="text-center" style="margin: .5rem 0 1rem 0;">SKPD TAHUN ANGGARAN {{ date('Y') }}</h4>
    <table class="table table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA PEJABAT</th>
                <th>NO SPT</th>
                <th>TANGGAL DINAS</th>
                <th>TUJUAN</th>
                <th>DALAM RANGKA</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @php $total = 0 @endphp
            @php $sub_total = 0 @endphp
            @php $log_name = "" @endphp
            @foreach ($reports as $report)
                @foreach ($report as $key => $item)             
                    <tr>
                        <td style="width: 40px; text-align: center;">{{ $no++ }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td style="width: 80px; text-align: right">{{ $item['number'] }}</td>
                        <td>{{ $item['date_range'] }}</td>
                        <td>{{ $item['destination'] }}</td>
                        <td>{{ $item['purpose'] }}</td>
                    </tr>
                    @php $total += $item['duration'] @endphp
                    @php $sub_total += $item['duration'] @endphp
                    @php $log_name = $item['name'] @endphp      
                    @if (count($report) === $key+1)
                        <tr style="background-color: #ccc ;">
                            <td></td>
                            <td>{{ $log_name }}</td>
                            <td></td>
                            <td><b>{{ $sub_total }} hari</b></td>
                            <td></td>
                            <td></td>                            
                        </tr>
                        @php $sub_total = 0 @endphp
                    @endif 
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right"><b>Grand Total</b></td>
                <td colspan="3"><b>{{ $total }} hari</b></td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>

</html>
