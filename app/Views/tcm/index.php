<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TCM Management - Index</title>
</head>
<body>
    <h1>TCM Management Dashboard</h1>

    <h2>Daftar Kegiatan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Kegiatan</th>
                <th>Jumlah TCM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kegiatan as $k): ?>
                <tr>
                    <td><?= $k['id'] ?></td>
                    <td><?= $k['jenisGiat'] ?></td>
                    <td><?= $k['countTcm'] ?></td>
                    <td>
                        <a href="/tcm-dashboard/edit/<?= $k['id'] ?>">Edit</a> |
                        <form action="/tcm-dashboard/delete/<?= $k['id'] ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Rekapitulasi TCM</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Status</th>
                <th>Jenis Kegiatan</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekapTcm as $t): ?>
                <tr>
                    <td><?= $t['serialNumber'] ?></td>
                    <td><?= $t['status'] ?></td>
                    <td><?= $t['jenisGiat'] ?></td>
                    <td><?= $t['lokasi'] ?? 'Tidak Diketahui' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/tcm-dashboard/create">Tambah Kegiatan Baru</a>
</body>
</html>
