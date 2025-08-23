<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">History Penempatan TCM</h2>
    </div>

    <?= anchor('tcm', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-5']); ?>

    <a href="/tcm/historyPenempatan" class="btn btn-primary mb-3">History Penempatan</a>

    <!-- TCM Information Card -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="my-3 text-primary-emphasis text-uppercase fw-bold">
                Informasi TCM
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-3 border bg-light rounded-3 mb-3">
                        <strong>Part Number:</strong><br>
                        <span class="fw-bold text-primary">
                            <?= esc($tcm['partNumber'] ?? 'N/A') ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border bg-light rounded-3 mb-3">
                        <strong>Serial Number:</strong><br>
                        <span class="fw-bold text-primary">
                            <?= esc($tcm['serialNumber'] ?? 'N/A') ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border bg-light rounded-3 mb-3">
                        <strong>Status:</strong><br>
                        <?php
                        $statusClass = '';
                        if ($tcm['status'] === 'Fired') {
                            $statusClass = 'text-danger';
                        } elseif ($tcm['status'] === 'Eternal Patrol') {
                            $statusClass = 'text-primary';
                        } elseif ($tcm['status'] === 'aktif') {
                            $statusClass = 'text-success';
                        }
                        ?>
                        <span class="<?= $statusClass; ?> fw-bold">
                            <?= esc($tcm['status'] ?? 'N/A') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="my-3 text-warning-emphasis text-uppercase fw-bold">
                Riwayat Lokasi
            </h3>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($historyPenempatan)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jenis Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historyPenempatan as $index => $history): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?php if (!empty($history['created_at'])): ?>
                                            <?= tampilTanggal(date('Y-m-d', strtotime($history['created_at']))) ?>
                                            <br>
                                            <small class="text-muted">
                                                <?= date('H:i', strtotime($history['created_at'])) ?> WIB
                                            </small>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php $badgeClass = 'badge bg-primary'; ?>
                                        <?php if (in_array($history['jenisGiat'], ['Barang Keluar', 'PUT'])): ?>
                                            <?php $badgeClass = 'badge bg-danger'; ?>
                                        <?php elseif (in_array($history['jenisGiat'], ['Barang Masuk', 'PUS'])): ?>
                                            <?php $badgeClass = 'badge bg-success'; ?>
                                        <?php endif; ?>
                                        <span class="<?= $badgeClass; ?>">
                                            <?= esc($history['jenisGiat'] ?? '-') ?>
                                        </span>
                                    </td>

                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">
                                            <?= esc($history['lokasiPenempatan'] ?? '-') ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?php
                                        $statusClass = '';
                                        if ($history['status'] === 'Fired') {
                                            $statusClass = 'text-danger';
                                        } elseif ($history['status'] === 'Eternal Patrol') {
                                            $statusClass = 'text-primary';
                                        } elseif ($history['status'] === 'aktif') {
                                            $statusClass = 'text-success';
                                        }
                                        ?>
                                        <span class="<?= $statusClass; ?> fw-medium">
                                            <?= esc($history['status'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            Transaksi ID: <?= esc($history['trxTcmId'] ?? '-') ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Tidak Ada Riwayat Penempatan</h5>
                    <p class="text-muted">TCM ini belum memiliki riwayat penempatan atau transaksi.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Summary Card -->
    <?php if (!empty($historyPenempatan)): ?>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="p-3 border bg-light rounded-3">
                            <h5 class="text-primary mb-2">Total Transaksi</h5>
                            <h3 class="fw-bold text-primary"><?= count($historyPenempatan) ?></h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border bg-light rounded-3">
                            <h5 class="text-success mb-2">Transaksi Pertama</h5>
                            <p class="fw-bold text-success mb-0">
                                <?php
                                $firstTransaction = end($historyPenempatan);
                                echo !empty($firstTransaction['created_at'])
                                    ? tampilTanggal(date('Y-m-d', strtotime($firstTransaction['created_at'])))
                                    : '-';
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border bg-light rounded-3">
                            <h5 class="text-warning mb-2">Transaksi Terakhir</h5>
                            <p class="fw-bold text-warning mb-0">
                                <?php
                                $lastTransaction = reset($historyPenempatan);
                                echo !empty($lastTransaction['created_at'])
                                    ? tampilTanggal(date('Y-m-d', strtotime($lastTransaction['created_at'])))
                                    : '-';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <br><br>

</main>

<?= $this->endSection(); ?>