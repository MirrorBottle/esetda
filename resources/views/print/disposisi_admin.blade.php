<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Disposisi Surat {{ $inbox->unique_key }}</title>
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

        .box-area {
            position: relative;
            display: inline;
        }

        .box-area .box {
            height: 6px;
            width: 4px;
            padding: 1px 10px;
            margin-right: 3px;
            border: 1px solid #000;
        }
        .box-area img {
            height: 23px;
            position: absolute;
            top: -8px;
            left: 0px;
        }
        .box-area img.check {
            height: 26px;
            top: -11px;
        }
        .box-area span {
            margin-left: 35px;
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
        @if ($kop_id == 3)
            {!! $kop->content !!}
        @endif

        <table style="text-align: center;">
            @if ($kop_id == 3)
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
                        <h3 style="margin-top: .8rem; margin-bottom: .4rem;">{{ $title }} KALIMANTAN TIMUR</h3>
                        <p><b>LEMBAR DISPOSISI</b></p>
                    </td>
                </tr>
            @endif
        </table>

        <table>
                <td style="width: 50%" style="padding: 6px 0;">
                    <table>
                        <tr>
                            <td style="width: 65px;">Surat dari</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ strtoupper($inbox->sender) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">No Surat</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $inbox->no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">Tgl Surat</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $date }}</td>
                        </tr>
                    </table>
                </td>
                <td style="border-left: 1px solid #000; padding: 6px 0;">
                    <table style="margin-left: 6px;">
                        <tr>
                            <td style="width: 65px;">Diterima Tgl</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $date_receipt }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">Pukul</td>
                            <td style="width: 10px;">:</td>
                            <td>
                                {{ $time }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">No Agenda</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $no_agenda }}</td>
                        </tr>
                        <tr>
                            <td style="width: 65px;">Sifat</td>
                            <td style="width: 10px;">:</td>
                            <td>{{ $property }} </td>
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
                            <td>{{ strtoupper($inbox->title) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table style="margin-top: 2rem; border: 0;">
            <tr>
                <td style="border-left: 0; border-right: 0; border-top: 1px solid #000; border-bottom: 1px solid #000; width: 50%;">
                    <p style="margin-bottom: 10px;"><u>Diteruskan Kepada :</u></p>
                    <ul>
                        @if (strpos($user->username, 'admin') !== false || strpos($user->username, 'pj') !== false)
                            @if ($kop_id == 1)
                                <li>
                                    <div class="box-area">
                                        @if ($disposisi !== null)
                                            @if ($disposisi->receiver_id == 2)
                                                <img src="{{ $square_check }}" class="check" alt="square check">
                                            @else
                                                <img src="{{ $square_blank }}" alt="square blank">
                                            @endif
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                        <span>Wakil Gubernur</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="box-area">
                                        @if ($disposisi !== null)
                                            @if ($disposisi->receiver_id == 3)
                                                <img src="{{ $square_check }}" class="check" alt="square check">
                                            @else
                                                <img src="{{ $square_blank }}" alt="square blank">
                                            @endif
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                        <span>Sekretaris Daerah</span>
                                    </div>
                                </li>
                            @elseif ($kop_id == 2)
                                <li>
                                    <div class="box-area">
                                        @if ($disposisi !== null)
                                            @if ($disposisi->receiver_id == 3)
                                                <img src="{{ $square_check }}" class="check" alt="square check">
                                            @else
                                                <img src="{{ $square_blank }}" alt="square blank">
                                            @endif
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                        <span>Sekretaris Daerah</span>
                                    </div>
                                </li>
                            @endif

                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 5 || $disposisi->receiver_id == 6 || $disposisi->receiver_id == 7)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 5 || $disposisi->receiver_id == 6 || $disposisi->receiver_id == 7)
                                            <span>{{ $disposisi->receiver->name_formatted }}</span>
                                        @else
                                            <span>Asisten</span>
                                        @endif
                                    @else
                                        <span>Asisten</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id >= 8 && $disposisi->receiver_id <= 16)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id >= 8 && $disposisi->receiver_id <= 16)
                                            <span>Kepala {{ $disposisi->receiver->name_formatted }}</span>
                                        @else
                                            <span>Kepala Biro</span>
                                        @endif
                                    @else
                                        <span>Kepala Biro</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 4)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 4)
                                            <span>Staf Ahli Bidang {{ ucwords(strtolower($disposisi->position)) }}</span>
                                        @else
                                            <span>Staf Ahli Bidang</span>
                                        @endif
                                    @else
                                        <span>Staf Ahli Bidang</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 63)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 63)
                                            <span>Kepala Badan {{ $disposisi->position }}</span>
                                        @else
                                            <span>Kepala Badan</span>
                                        @endif
                                    @else
                                        <span>Kepala Badan</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 64)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 64)
                                            <span>Kepala Dinas {{ $disposisi->position }}</span>
                                        @else
                                            <span>Kepala Dinas</span>
                                        @endif
                                    @else
                                        <span>Kepala Dinas</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 65)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 65)
                                            <span>Ka Inspektorat {{ $disposisi->position }}</span>
                                        @else
                                            <span>Ka Inspektorat</span>
                                        @endif
                                    @else
                                        <span>Ka Inspektorat</span>
                                    @endif
                                </div>
                            </li>
                            {{-- <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 66)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif
                                    <span>Kasubag Tu Pimpinan</span>
                                </div>
                            </li> --}}
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 67)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 67)
                                            <span>Protokol {{ $disposisi->position }}</span>
                                        @else
                                            <span>Protokol</span>
                                        @endif
                                    @else
                                        <span>Protokol</span>
                                    @endif
                                </div>
                            </li>
                        @else
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id >= 8 && $disposisi->receiver_id <= 16)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id >= 8 && $disposisi->receiver_id <= 16)
                                            <span>Kepala {{ $disposisi->receiver->name_formatted }}</span>
                                        @else
                                            <span>Kepala Biro</span>
                                        @endif
                                    @else
                                        <span>Kepala Biro</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 68)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 68)
                                            <span>Kabag {{ $disposisi->position }}</span>
                                        @else
                                            <span>Kabag</span>
                                        @endif
                                    @else
                                        <span>Kabag</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 69)
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif

                                    @if ($disposisi !== null)
                                        @if ($disposisi->receiver_id == 69)
                                            <span>Kasubag {{ $disposisi->position }}</span>
                                        @else
                                            <span>Kasubag</span>
                                        @endif
                                    @else
                                        <span>Kasubag</span>
                                    @endif
                                </div>
                            </li>
                        @endif
                    </ul>
                </td>
                <td style="padding-left: 6px; width: 50%; border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid #000; border-right: 0;">
                    <p style="margin-bottom: 10px;">Disposisi</p>
                    <ul>
                        @foreach ($disposisi_item as $index => $item)
                            <li>
                                <div class="box-area">
                                    @if ($disposisi !== null)
                                        @if (in_array($index, $disposisi->actions ?? []))
                                            <img src="{{ $square_check }}" class="check" alt="square check">
                                        @else
                                            <img src="{{ $square_blank }}" alt="square blank">
                                        @endif
                                    @else
                                        <img src="{{ $square_blank }}" alt="square blank">
                                    @endif
                                    <span>{{ $item }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Catatan :</p>
                    <p style="margin-top: 4px; font-weight: bold; font-size: 13px;">{{ $disposisi->description ?? '-' }}</p>
                </td>
            </tr>
        </table>

        <table style="margin-top: 3rem;">
            <tr>
                <td style="width: 70%">&nbsp;</td>
                <td style="width: 30%">
                    <div style="text-align: center;">
                        <p class="mb-0">{{ $position }}</p>
                        @if ($disposisi !== null)
                            @if ($disposisi->signature_image !== null)
                                <img src="{{ $disposisi->signature_image_string }}" alt="ttd digital" style="height: 100px; margin: 12px 0;">
                                <p>{{ $name }}</p>
                            @else
                                <p style="margin-top: 4rem;">{{ $name }}</p>
                            @endif
                        @else
                            <p style="margin-top: 4rem;">{{ $name }}</p>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
