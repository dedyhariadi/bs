<?php

/**
 * File: terbilang_helper.php
 * Helper untuk mengkonversi angka menjadi terbilang dalam Bahasa Indonesia.
 */

if (! function_exists('terbilang')) {
    /**
     * Mengkonversi angka menjadi terbilang dalam Bahasa Indonesia.
     *
     * @param int|float $x Angka yang akan dibilang
     * @return string
     */
    function terbilang($x)
    {
        $x = abs($x);
        $angka = array(
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas"
        );
        $temp = "";
        if ($x < 12) {
            $temp = " " . $angka[$x];
        } else if ($x < 20) {
            $temp = terbilang($x - 10) . " belas";
        } else if ($x < 100) {
            $temp = terbilang($x / 10) . " puluh" . terbilang($x % 10);
        } else if ($x < 200) {
            $temp = " seratus" . terbilang($x - 100);
        } else if ($x < 1000) {
            $temp = terbilang($x / 100) . " ratus" . terbilang($x % 100);
        } else if ($x < 2000) {
            $temp = " seribu" . terbilang($x - 1000);
        } else if ($x < 1000000) {
            $temp = terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
        } else if ($x < 1000000000) {
            $temp = terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
        } else if ($x < 1000000000000) {
            $temp = terbilang($x / 1000000000) . " milyar" . terbilang(fmod($x, 1000000000));
        } else if ($x < 1000000000000000) {
            $temp = terbilang($x / 1000000000000) . " trilyun" . terbilang(fmod($x, 1000000000000));
        }
        return $temp;
    }
}

if (!function_exists('simpanTanggal')) {
    function simpanTanggal($tanggal)
    {
        list(, $tanggal_str) = explode(', ', $tanggal, 2);
        $tanggal_str = trim($tanggal_str);
        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        $bulan_inggris = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $tanggal_inggris = str_replace($bulan_indonesia, $bulan_inggris, $tanggal_str);
        $objek_tanggal = \DateTime::createFromFormat('d F Y', $tanggal_inggris);
        return $objek_tanggal ? $objek_tanggal->format('Y-m-d') : null;
    }
}
// Fungsi ini mengkonversi tanggal dalam format "Senin, 1 Januari 2023" menjadi "2023-01-01".
// Pastikan untuk memanggil fungsi ini dengan tanggal yang sesuai format tersebut.

// if (!function_exists('tampilTanggal')) {
//     function tampilTanggal($tgl)
//     {
//         // Format tanggal menjadi "senin, 07 agustus 2025"
//         setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'Indonesian_indonesia');


//         $tanggalFormatted = strftime('%A, %d %B %Y', strtotime($tgl));
//         return $tanggalFormatted;
//     }
// }


if (!function_exists('tampilTanggal')) {
    /**
     * Mengubah tanggal format YYYY-MM-DD menjadi "hari, dd Bulan YYYY" dalam Bahasa Indonesia.
     *
     * @param string $tgl Format: 'YYYY-MM-DD'
     * @return string
     */
    function tampilTanggal($tgl)
    {
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'Nopember',
            12 => 'Desember'
        ];

        $timestamp = strtotime($tgl);
        if (!$timestamp) {
            return '';
        }

        $hariIndo = $hari[date('l', $timestamp)];
        $tanggal = date('d', $timestamp);
        $bulanIndo = $bulan[(int)date('m', $timestamp)];
        $tahun = date('Y', $timestamp);

        return $hariIndo . ', ' . $tanggal . ' ' . $bulanIndo . ' ' . $tahun;
    }
}
