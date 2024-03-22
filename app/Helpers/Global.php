<?php

use Carbon\Carbon;

function biro_name()
{
    return auth()->user()->biro->name;
}

function to_indo_day($day)
{
    $list_day = [
        1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
    ];

    return $list_day[(int) $day];
}

function to_indo_month($month, $short = false)
{
    $list_month = [
        1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
    ];

    if ($short) {
        return substr($list_month[(int) $month], 0, 3);
    }

    return $list_month[(int) $month];
}

function from_indo_month($month_name)
{
    $list_month = [
        'Januari' => '01',
        'Februari' => '02',
        'Maret' => '03',
        'April' => '04',
        'Mei' => '05',
        'Juni' => '06',
        'Juli' => '07',
        'Agustus' => '08',
        'September' => '09',
        'Oktober' => '10',
        'November' => '11',
        'Desember' => '12'
    ];

    return $list_month[$month_name];
}

function to_mysql_date($date, $separator = ' ', $short = false)
{
    $split_date = explode('-', $date);
    return $split_date[2] .$separator.
    to_indo_month($split_date[1], $short) .$separator.
        $split_date[0];
}

// type null = angka bulan
// type 1 = nama bulan panjang
// type 2 = nama bulan pendek
function to_indo_date($date, $type = null, $separator = ' ')
{
    $split_date = explode('-', $date);

    if ($type == 1) {
        return $split_date[2]
            .$separator. to_indo_month($split_date[1])
            .$separator. $split_date[0];
    } else if ($type == 2) {
        return $split_date[2]
            .$separator. to_indo_month($split_date[1], true)
            .$separator. $split_date[0];
    }

    return $split_date[2] .$separator. $split_date[1] .$separator. $split_date[0];
}

function from_indo_date($date, $type = null, $separator = ' ')
{
    $split_date = explode('-', $date);

    if ($type == 1) {
        return $split_date[2]
            .$separator. to_indo_month($split_date[1])
            .$separator. $split_date[0];
    } else if ($type == 2) {
        return $split_date[2]
            .$separator. to_indo_month($split_date[1], true)
            .$separator. $split_date[0];
    }

    return $split_date[2] .$separator. $split_date[1] .$separator. $split_date[0];
}

function full_indo_date($date) 
{
    $date = Carbon::parse($date);
    $day = to_indo_day($date->copy()->format('N'));
    $format = to_indo_date($date->copy()->format('Y-m-d'), 1);

    return $day . ', ' . $format;
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function unique_key()
{
    $code = \Illuminate\Support\Facades\Hash::make(time());
    $code = preg_replace('/[^\p{L}\p{N}\s]/u', '', $code);
    $code = strtoupper(substr($code, 8));
    $first_code = substr($code, 0, 4);
    $last_code = substr($code, -4);

    return $first_code .'-'. $last_code .'-'. date('ymd');
}

function image_to_base64($image_path)
{
    $encoded_image = base64_encode(file_get_contents($image_path));

    return "data:image/png;base64, ". $encoded_image;
}
