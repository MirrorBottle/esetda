<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Disposisi No. {{ $no }} - {{ date('d F Y') }}</title>
    <!-- Styles -->
    <style>
        body {
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            /* margin-top: -4rem; */
        }
        table {
            font-size: 11px;
            border-spacing: 0;
            border-collapse: collapse;
            width: 100%;
        }
        tr th, tr td, .rekap p {
            border-color: #000 !important;
            line-height: 1.2;
        }
        .header-wrapper {
            margin: 0 auto;
        }
        .table-bordered, .table-bordered td, .table-bordered th, .table thead th {
            border-color: #000 !important;
        }
        th {
            text-align: center;
        }
        td {
            vertical-align: top;
            padding: 3px;
        }
        h1, h2, h3, h4, h5, h6, p {
            margin: 0;
        }
        hr {
            border-color: #000;
        }
        .box {
            height: 6px;
            width: 4px;
            padding: 1px 10px;
            margin-right: 3px;
            border: 1px solid #000;
        }
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        ul > li {
            margin-bottom: 12px;
        }

    </style>
</head>
<body>
    <div class="container" id="htmlContent">
        @if ($data['kop'] == '0')
            {!! $kop->content !!}
        @endif

        <table style="text-align: center;">
            @if ($data['kop'] == '0')
                <tr>
                    @php $top_line = 'border-top: 1px solid #000' @endphp
                    <td style="border-bottom: 1px solid #000; text-align: center; {{ $top_line }}">
                        <b>LEMBAR DISPOSISI</b>
                    </td>
                </tr>
            @else
                <tr>
                    <td>
                        {!! $kop->content !!}
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000;">
                        <h3 style="margin-top: .8rem; margin-bottom: .4rem;">{{ $custom['title'] }} KALIMANTAN TIMUR</h3>
                        <p><b>LEMBAR DISPOSISI</b></p>
                    </td>
                </tr>
            @endif
        </table>

        <table>
            <tr>
                <td style="width: 50%" style="padding: 6px 0;">
                    <table>
                        <tr>
                            <td style="width: 65px;">Surat dari</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ strtoupper($data['sender']) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">No Surat</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $data['no_letter'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">Tgl Surat</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $custom['date'] }}</td>
                        </tr>
                    </table>
                </td>
                <td style="border-left: 1px solid #000; padding: 6px 0;">
                    <table style="margin-left: 6px;">
                        <tr>
                            <td style="width: 65px;">Diterima Tgl</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $custom['date_receipt'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">Pukul</td>
                            <td style="width: 10px;">:</td>
                            <td>
                                {{ $custom['time'] == '' ? '' : $custom['time'] . ' WITA' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">No Agenda</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $data['no_agenda'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">Sifat</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $custom['property'] }} </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid #000;">
                    <table>
                        <tr>
                            <td style="width: 65px;">Hal</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ strtoupper($data['description']) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table style="margin-top: 2rem;">
            <tr>
                <td style="border: 1px solid #000; border-left: 0; width: 50%;">
                    <p style="margin-bottom: 10px;"><u>Diteruskan Kepada :</u></p>
                    <ul>
                        @if (auth()->user()->biro_id == 1)
                            @if ($data['kop'] == '1')
                                <li><span class="box">&nbsp;</span> Sekretaris Daerah</li>
                            @elseif ($data['kop'] == '2')
                                <li><span class="box">&nbsp;</span> Sekretaris Daerah</li>
                            @endif

                            <li><span class="box">&nbsp;</span> Asisten ....................................</li>
                            <li><span class="box">&nbsp;</span> Kepala Biro .......................................</li>
                            <li><span class="box">&nbsp;</span> Staf Ahli Bidang ......................</li>
                            <li><span class="box">&nbsp;</span> Kepala Badan .........................</li>
                            <li><span class="box">&nbsp;</span> Kepala Dinas ..........................</li>
                            <li><span class="box">&nbsp;</span> Ka Inspektorat ........................</li>
                            <li><span class="box">&nbsp;</span> Sekretaris Dewan ........................</li>
                            <li><span class="box">&nbsp;</span> Kasatpol PP ........................</li>
                            {{-- <li><span class="box">&nbsp;</span> Kasubag Tu Pimpinan ...</li> --}}
                            <li><span class="box">&nbsp;</span> Protokol ..................................</li>
                        @else
                            <li><span class="box">&nbsp;</span> Kepala Biro .......................................</li>
                            <li><span class="box">&nbsp;</span> Kabag ...............................................</li>
                            <li><span class="box">&nbsp;</span> Kasubag ...........................................</li>
                        @endif
                    </ul>
                </td>
                <td style="padding-left: 6px; width: 50%; border: 1px solid #000; border-left: 0; border-right: 0;">
                    <p style="margin-bottom: 10px;">Disposisi</p>
                    <ul>
                        <li><span class="box">&nbsp;</span> Proses lebih lanjut</li>
                        <li><span class="box">&nbsp;</span> Tanggapan dan saran</li>
                        <li><span class="box">&nbsp;</span> Jadwalkan</li>
                        <li><span class="box">&nbsp;</span> Wakili/Dampingi</li>
                        <li><span class="box">&nbsp;</span> Siapkan Bahan/Pointer</li>
                        <li><span class="box">&nbsp;</span> Koordinasikan</li>
                        <li><span class="box">&nbsp;</span> Monitor / Cermati</li>
                        <li><span class="box">&nbsp;</span> Laksanakan</li>
                        <li><span class="box">&nbsp;</span> Sebagai Masukan</li>
                        <li><span class="box">&nbsp;</span> File / Simpan</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Catatan :
                </td>
            </tr>
        </table>

        @if ($custom['ttd_area'])
            <table style="margin-top: 3rem;">
                <tr>
                    <td style="width: 60%">&nbsp;</td>
                    <td style="width: 40%">
                        <div style="text-align: center;">
                            <p>{{ $custom['position'] }}</p>
                            <p style="margin-top: 4rem;">{{ $custom['name'] }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        @endif

    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
