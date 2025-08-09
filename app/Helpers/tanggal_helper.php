<?php
// Pindahkan fungsi parseTanggalIndonesia ke file helper agar bisa digunakan di controller lain.
// Buat file baru di app/Helpers/tanggal_helper.php dengan isi seperti berikut:

if (!function_exists('parseTanggalIndonesia')) {
    function parseTanggalIndonesia($tanggal_dari_form)
    {
        list(, $tanggal_str) = explode(', ', $tanggal_dari_form, 2);
        $tanggal_str = trim($tanggal_str);
        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        $bulan_inggris = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $tanggal_inggris = str_replace($bulan_indonesia, $bulan_inggris, $tanggal_str);
        $objek_tanggal = \DateTime::createFromFormat('d F Y', $tanggal_inggris);
        return $objek_tanggal ? $objek_tanggal->format('Y-m-d') : null;
    }
}
