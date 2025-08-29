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
