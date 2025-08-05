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
