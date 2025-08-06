<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <!-- <h2 class="h2">Torpedo Counter Measure</h2> -->
    </div>

    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addTambahTcmModal">
        Transaksi Baru
    </button>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0"><?= $jenis['nama']; ?></h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Part Number</th>
                            <th>Serial Number</th>
                            <th>Status</th>
                            <th>Posisi</th>
                            <th>Dasar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tcmList as $index => $tcm): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($tcm['partNumber']) ?></td>
                                <td><?= esc($tcm['serialNumber']) ?></td>
                                <td><?= esc($tcm['status']) ?></td>
                                <td>posisi</td>
                                <td>
                                    <a href="<?= base_url('tcm/edit/' . $tcm['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?= base_url('tcm/delete/' . $tcm['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <br><br>


    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addTambahTcmModal" tabindex="-1" aria-labelledby="addTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <?= form_open('tcm/tambah', '', ['jenisId' => $jenis['id']]); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiModalLabel">Tambah Data <?= $jenis['nama']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="partnumber" class="form-label">Part Number</label>
                        <input type="text" class="form-control fs-3" id="partnumber" name="partnumber">
                    </div>
                    <div class="mb-3">
                        <label for="serialnumber" class="form-label">Serial Number</label>
                        <input type="text" class="form-control fs-3" id="serialnumber" name="serialnumber" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <?= form_dropdown(
                            'status',
                            [
                                'aktif' => 'Aktif',
                                'fired' => 'Fired',
                                'eternal patrol' => 'Eternal Patrol'
                            ],
                            '',
                            ['class' => 'form-select fs-3', 'id' => 'status', 'required' => true]
                        ); ?>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>



    <?= $this->endSection(); ?>