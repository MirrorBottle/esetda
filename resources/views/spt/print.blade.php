<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SPT_NO_{{ $spt->letter_number_zero_pad }}_{{ date('dmY') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Styles -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            color: #000;
            width: 100%;
        }

        .table {
            /* font-size: 11px; */
            width: 100%;
        }

        .table th,
        .table td {
            word-wrap: break-word;
            padding: 1.5px;
            border: 0;
        }

        .header-wrapper {
            margin: 0 auto;
        }

        .table-bordered,
        .table-bordered td,
        .table-bordered th,
        .table-bordered thead th {
            border: 1px solid #000 !important;
            padding: 1.6px 4px;
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

        h4 {
            font-size: 24px;
            font-weight: bold;
        }

        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    @foreach (range(1, 2) as $page_index)
        <div class="pagebreak">
            {{-- header --}}
            <div class="text-center">
                <h4>SEKRETARIS DAERAH PROVINSI KALIMANTAN TIMUR</h4>
                <h4 style="margin: 4px 0;">SURAT PERINTAH DINAS/SURAT TUGAS</h4>
                <p>Nomor : 800.1.11.1/{{ $spt->letter_number_zero_pad }}/B.Um.I</p>
            </div>

            {{-- intro --}}
            <table class="table mt-2">
                <tr>
                    <td style="width: 80px;">Dasar</td>
                    <td style="width: 20px;">:</td>
                    <td>{{ $spt->inbox->no }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;"><b>MEMERINTAHKAN</b></td>
                </tr>
                <tr>
                    <td>Kepada</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>

            {{-- employee info  --}}
            <table class="table">
                @foreach ($spt->skpd_employees() as $skpd_employee)
                    <tr>
                        <td style="width: 20px;">{{ $loop->iteration }}.</td>
                        <td style="width: 200px;">a. Nama</td>
                        <td style="width: 30px;">:</td>
                        <td><b>{{ $skpd_employee->name }}</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>b. N i p</td>
                        <td>:</td>
                        <td>{{ $skpd_employee->nip ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>c. Jabatan/Golongan</td>
                        <td>:</td>
                        <td>{{ $skpd_employee->position }}
                            {{ $skpd_employee->group !== null ? '(' . $skpd_employee->group . ')' : '' }}</td>
                    </tr>
                @endforeach
            </table>

            {{-- another info  --}}
            <table class="table">
                <tr>
                    <td style="width: 20px;"></td>
                    <td style="width: 200px;">Dalam rangka</td>
                    <td style="width: 30px;">:</td>
                    <td><b>{{ $spt->purpose }}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tempat Berangkat</td>
                    <td>:</td>
                    <td><b>{{ $spt->place }}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tujuan</td>
                    <td>:</td>
                    <td><b>{{ $spt->destination }}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Lamanya</td>
                    <td>:</td>
                    <td>{{ $spt->duration }} hari</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tanggal Berangkat</td>
                    <td>:</td>
                    <td>{{ to_indo_date($spt->departure_date->format('Y-m-d'), 1) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tanggal Kembali</td>
                    <td>:</td>
                    <td>{{ to_indo_date($spt->return_date->format('Y-m-d'), 1) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Beban Anggaran</td>
                    <td>:</td>
                    <td>{!! $spt->budget_expanse !!}</td>
                </tr>
            </table>

            {{-- footer info --}}
            <p class="mb-3">Demikian surat perintah tugas ini di berikan agar di pergunakan sebagaimana mestinya
                dan<br>Setelah melaksanakan tugas agar membuat laporan.</p>

            {{-- ttd area --}}
            <table class="table mb-0">
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;">
                        <p>Dikeluarkan di : Samarinda</p>
                        <p class="mb-3">Pada Tanggal : {{ to_indo_date($spt->letter_date->format('Y-m-d'), 1) }}</p>

                        <div style="font-weight:bold;">
                            <p style="white-space: pre-line">{{ $spt->signer->title }}</p>
                            <p style="margin-top: 7rem;"><u>{{ $spt->signer->name }}</u></p>
                            <p>{{ $spt->signer->position }}</p>
                            <p>NIP. {{ $spt->signer->nip }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($page_index == 2 && $spt->letter_signers !== null)
                            <table class="table table-bordered mb-0" style="width: 70%;">
                                <tr>
                                    <th style="width: 180px;">Nama</th>
                                    <th>Jabatan</th>
                                    <th>Paraf</th>
                                </tr>
                                @foreach ($spt->letter_signer_list['name'] as $key => $signer_name)
                                    <tr>
                                        <td>{{ $signer_name }}</td>
                                        <td>{{ $spt->letter_signer_list['position'][$key] }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    @endforeach

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
