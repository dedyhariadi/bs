<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Kegiatan TCM</title>
</head>

<body>
    <h1>Edit Kegiatan</h1>

    <?php if (session()->get('errors')): ?>
        <ul>
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="/tcm-dashboard/update/<?= $kegiatan['id'] ?>" method="post">
        <label>Jenis Kegiatan:</label>
        <select name="jenisGiat" required>
            <option value="Barang Masuk" <?= $kegiatan['jenisGiat'] == 'Barang Masuk' ? 'selected' : '' ?>>Barang Masuk</option>
            <option value="Barang Keluar" <?= $kegiatan['jenisGiat'] == 'Barang Keluar' ? 'selected' : '' ?>>Barang Keluar</option>
            <option value="PUT" <?= $kegiatan['jenisGiat'] == 'PUT' ? 'selected' : '' ?>>PUT</option>
            <option value="PUS" <?= $kegiatan['jenisGiat'] == 'PUS' ? 'selected' : '' ?>>PUS</option>
        </select><br>

        <label>Surat ID:</label>
        <input type="number" name="suratId" value="<?= $kegiatan['suratId'] ?>" required><br>

        <label>Transfer Dari:</label>
        <select name="transferDariId" required>
            <?php foreach ($satkaiList as $s): ?>
                <option value="<?= $s['id'] ?>" <?= $kegiatan['transferDariId'] == $s['id'] ? 'selected' : '' ?>><?= $s['satkai'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Transfer Ke:</label>
        <select name="transferKeId" required>
            <?php foreach ($satkaiList as $s): ?>
                <option value="<?= $s['id'] ?>" <?= $kegiatan['transferKeId'] == $s['id'] ? 'selected' : '' ?>><?= $s['satkai'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Tanggal Pelaksanaan:</label>
        <input type="datetime-local" name="tglPelaksanaan" value="<?= date('Y-m-d\TH:i', strtotime($kegiatan['tglPelaksanaan'])) ?>"><br>

        <label>Keterangan:</label>
        <textarea name="keterangan"><?= $kegiatan['keterangan'] ?></textarea><br>

        <label>Pilih TCM:</label><br>
        <?php foreach ($tcmList as $t): ?>
            <input type="checkbox" name="tcmIds[]" value="<?= $t['id'] ?>" checked> <!-- Asumsikan semua checked, bisa disesuaikan -->
            <?= $t['serialNumber'] ?> (<?= $t['jenis_nama'] ?>)<br>
        <?php endforeach; ?>

        <button type="submit">Update</button>
    </form>

    <a href="/tcm-dashboard">Kembali</a>
</body>

</html>