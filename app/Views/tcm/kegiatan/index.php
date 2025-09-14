<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Torpedo Countermeasure</h1>
    </div>



    <div class="text-center fw-bold fs-2 mt-4 mb-3">
        Kegiatan
    </div>


    <div class="row">
        <div class="col-12">
            <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col">#</th>
                        <th scope="col">TGL PELAKSANAAN</th>
                        <th scope="col">JENIS</th>
                        <th scope="col">TRANSFER DARI</th>
                        <th scope="col">TRANSFER KE</th>
                        <th scope="col">JUMLAH</th>
                        <th scope="col"></th>
                    </tr>

                <tbody>
                    <?php

                    ?>
                    <?php foreach ($kegiatan as $index => $item): ?>
                        <tr class="fs-4">
                            <td scope="row" class="text-center"><?= $index + 1; ?></td>
                            <td class="ps-5 text-uppercase"><?= anchor('tcm/kegiatan/' . $item['id'], tampilTanggal($item['tglPelaksanaan']), ['class' => 'link-success ']); ?></td>
                            <td class="text-center"> <?= $item['jenisGiat']; ?></td>
                            <td>
                                <?= array_column($satkai, 'satkai', 'id')[$item['transferDariId']] ?? ''; ?>
                            </td>
                            <td>
                                <?= array_column($satkai, 'satkai', 'id')[$item['transferKeId']] ?? ''; ?>
                            </td>

                            <td class="text-center"><?= $item['countTcm'] . ' unit'; ?></td>
                            <td>

                                <?= form_open('tcm/kegiatan/' . $item['id'], '', ['_method' => 'DELETE', 'class' => 'form-control', 'id' => $item['id']]); ?>

                                <?= anchor('tcm/kegiatan/' . $item['id'], '<i class="bi bi-zoom-in"></i>', ['class' => 'btn btn-outline-success']); ?> &nbsp;


                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editJenisModal<?= $item['id']; ?>"> <i class="bi bi-pen-fill"></i>
                                </button>&nbsp;

                                <?= form_button([
                                    'class'   => 'btn btn-outline-danger d-inline',
                                    'type'    => 'submit',
                                    'content' => '<i class="bi bi-trash3"></i>',
                                    'onclick' => "return confirm('Apakah anda yakin menghapus ini?');"
                                ]); ?>

                                <?= form_close(); ?>



                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th scope="row"></th>
                        <td class="text-start pt-4 ps-5 fw-bold" colspan="7">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Kegiatan
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Jenis Modal -->
    <div class="modal modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kegiatan Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('tcm/kegiatan'); ?>

                    <div class="form-floating mb-3">
                        <?php
                        $jenisGiat = [
                            'Barang Masuk' => 'Barang Masuk',
                            'PUT' => 'PUT',
                            'PUS' => 'PUS',
                            'Barang Keluar' => 'Barang Keluar'
                        ];
                        echo form_dropdown('jenis', $jenisGiat, ' ', ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                        echo form_label('Jenis Kegiatan', 'jenis', ['class' => 'form-label fs-5']);
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?php
                        echo form_dropdown('surat', array_column($surat, 'noSurat', 'id'), ' ', ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                        echo form_label('Surat', 'surat', ['class' => 'form-label fs-5']);
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <?php
                        echo form_dropdown('transferDari', array_column($satkai, 'satkai', 'id'), ' ', ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                        echo form_label('Transfer <span class="text-danger fw-bold fs-3">Dari</span>', 'transferDari', ['class' => 'form-label fs-5']);
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <?php
                        echo form_dropdown('transferKe', array_column($satkai, 'satkai', 'id'), ' ', ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                        echo form_label('Transfer <span class="text-success fw-bold fs-3">Ke</span>', 'transferKe', ['class' => 'form-label fs-5']);
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <?php
                        echo form_input('tglPelaksanaan', ' ', ['class' => 'form-select fs-2 tanggal-input', 'required' => 'true', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                        echo form_label('Tanggal Pelaksanaan', 'tglPelaksanaan', ['class' => 'form-label fs-5']);
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control fs-2" id="keterangan" name="keterangan" rows="2" autocomplete="off"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Jenis Modal -->
    <?php
    foreach ($kegiatan as $item):
        // Modal untuk setiap item jika diperlukan
    ?>
        <div class="modal modal-lg" id="editJenisModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="editJenisModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editJenisModalLabel">Edit Jenis TCM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('tcm/kegiatan/' . $item['id'], '', ['class' => 'form-control', '_method' => 'PUT']); ?>

                        <div class="form-floating mb-3">
                            <?php
                            if ($item['jenisGiat'] == 'Barang Masuk') {
                                $jenisGiat = [
                                    'Barang Masuk' => 'Barang Masuk',
                                ];
                            } else {
                                $jenisGiat = [
                                    'PUT' => 'PUT',
                                    'PUS' => 'PUS',
                                    'Barang Keluar' => 'Barang Keluar'
                                ];
                            }


                            echo form_dropdown('jenis', $jenisGiat, $item['jenisGiat'], ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                            echo form_label('Jenis Kegiatan', 'jenis', ['class' => 'form-label fs-5']);
                            ?>
                        </div>

                        <div class="form-floating mb-3">
                            <?php
                            echo form_dropdown('surat', array_column($surat, 'noSurat', 'id'), $item['suratId'], ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                            echo form_label('Surat', 'surat', ['class' => 'form-label fs-5']);
                            ?>
                        </div>
                        <div class="form-floating mb-3">
                            <?php
                            echo form_dropdown('transferDari', array_column($satkai, 'satkai', 'id'), $item['transferDariId'], ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                            echo form_label('Transfer <span class="text-danger fw-bold fs-3">Dari</span>', 'transferDari', ['class' => 'form-label fs-5']);
                            ?>
                        </div>
                        <div class="form-floating mb-3">
                            <?php
                            echo form_dropdown('transferKe', array_column($satkai, 'satkai', 'id'), $item['transferKeId'], ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                            echo form_label('Transfer <span class="text-success fw-bold fs-3">Ke</span>', 'transferKe', ['class' => 'form-label fs-5']);
                            ?>
                        </div>
                        <div class="form-floating mb-3">
                            <?php
                            echo form_input('tglPelaksanaan', tampilTanggal($item['tglPelaksanaan']), ['class' => 'form-select fs-2 tanggal-input', 'required' => 'true', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
                            echo form_label('Tanggal Pelaksanaan', 'tglPelaksanaan', ['class' => 'form-label fs-5']);
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control fs-2" id="keterangan" name="keterangan" rows="2" autocomplete="off"><?= esc($item['keterangan']) ?></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>


                        <script>
                            document.getElementById('editJenisModal<?= $item['id']; ?>').querySelector('form').addEventListener('submit', function(e) {
                                const dari = this.elements['transferDari'].value;
                                const ke = this.elements['transferKe'].value;
                                if (dari === ke) {
                                    e.preventDefault();
                                    alert('Transfer Dari dan Transfer Ke harus berbeda!');
                                }
                            });

                            document.getElementById('exampleModal').querySelector('form').addEventListener('submit', function(e) {
                                const dari = this.elements['transferDari'].value;
                                const ke = this.elements['transferKe'].value;
                                if (dari === ke) {
                                    e.preventDefault();
                                    alert('Transfer Dari dan Transfer Ke harus berbeda!');
                                }
                            });
                        </script>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>

</main>



<?= $this->endSection(); ?>