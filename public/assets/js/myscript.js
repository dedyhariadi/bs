function formatRupiah(el) {
  let angka = el.value.replace(/[^,\d]/g, "");
  let split = angka.split(",");
  let sisa = split[0].length % 3;
  let rupiah = split[0].substr(0, sisa);
  let ribuan = split[0].substr(sisa).match(/\d{3}/g);

  if (ribuan) {
    rupiah += (sisa ? "." : "") + ribuan.join(".");
  }

  rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
  // Hapus 0 di depan
  if (rupiah.startsWith("0")) {
    rupiah = rupiah.replace(/^0+/, "");
  }
  el.value = rupiah ? "Rp " + rupiah : "";
}


$(document).ready(function () {
  //datepicker
  $(".tanggal-input").datepicker({
    showAnim: "slideDown",
    dateFormat: "DD, dd MM yy",
    changeMonth: true,
    changeYear: true,
    regional: "id",
    dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
    monthNames: [
      "Januari",
      "Februari",
      "Maret",
      "April",
      "Mei",
      "Juni",
      "Juli",
      "Agustus",
      "September",
      "Oktober",
      "Nopember",
      "Desember",
    ],
    dayNamesMin: ["Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
    weekHeader: "Sn",
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var toastElList = [].slice.call(document.querySelectorAll(".toast"));
  toastElList.forEach(function (toastEl) {
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
  });
});
