<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Kegiatan TCM</title>
</head>

<body>
    <h1>Tambah Kegiatan Baru</h1>

    <?php if (session()->get('errors')): ?>
        <ul>
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="/tcm-dashboard/store" method="post">
        <label>Jenis Kegiatan:</label>
        <select name="jenisGiat" required>
            <option value="Barang Masuk">Barang Masuk</option>
            <option value="Barang Keluar">Barang Keluar</option>
            <option value="PUT">PUT</option>
            <option value="PUS">PUS</option>
        </select><br>

        <label>Surat ID:</label>
        <input type="number" name="suratId" required><br>

        <label>Transfer Dari:</label>
        <select name="transferDariId" required>
            <?php foreach ($satkaiList as $s): ?>
                <option value="<?= $s['id'] ?>"><?= $s['satkai'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Transfer Ke:</label>
        <select name="transferKeId" required>
            <?php foreach ($satkaiList as $s): ?>
                <option value="<?= $s['id'] ?>"><?= $s['satkai'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Tanggal Pelaksanaan:</label>
        <input type="datetime-local" name="tglPelaksanaan"><br>

        <label>Keterangan:</label>
        <textarea name="keterangan"></textarea><br>

        <label>Pilih TCM:</label><br>
        <?php foreach ($tcmList as $t): ?>
            <input type="checkbox" name="tcmIds[]" value="<?= $t['id'] ?>">
            <?= $t['serialNumber'] ?> (<?= $t['jenis_nama'] ?>)<br>
        <?php endforeach; ?>

        <button type="submit">Simpan</button>
    </form>

    <a href="/tcm">Kembali</a>
</body>

</html>