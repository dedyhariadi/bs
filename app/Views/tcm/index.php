<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <!-- <h2 class="h2">Torpedo Counter Measure</h2> -->
    </div>


    <div class="accordion mt-3" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    TORPEDO COUNTER MEASURE (TCM)
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">


                            <table class="table table-hover">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($jenis as $item) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td>
                                                <?= anchor('tcm/detail/' . $item['id'], $item['nama'], ['class' => 'link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover']); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $count = 0;
                                                foreach ($tcm as $row) {
                                                    if ($row['jenisId'] == $item['id']) {
                                                        $count++;
                                                    }
                                                }
                                                echo $count . ' unit';
                                                ?>

                                            </td>
                                            <td>@mdo</td>
                                            <td>@mdo</td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>

                                    <tr>
                                        <th scope="row"></th>
                                        <td colspan="4">
                                            <?= anchor('#addTambahTcmModal', 'Tambah Data', [
                                                'class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover',
                                                'data-bs-toggle' => 'modal'
                                            ]); ?>

                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    SURAT
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
            </div>
        </div>

    </div>


    <br><br>


    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addTambahTcmModal" tabindex="-1" aria-labelledby="addTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('tcm/tambah'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTransaksiModalLabel">Tambah Data TCM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="jenisId" class="form-label">Jenis</label>
                            <?= form_dropdown(
                                'jenisId',
                                array_column($jenis, 'nama', 'id'),
                                '',
                                ['class' => 'form-select fs-3', 'id' => 'jenisId', 'required' => true]
                            ); ?>
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

                        <div class="mb-3">
                            <label for="partnumber" class="form-label">Part Number</label>
                            <input type="text" class="form-control fs-3" id="partnumber" name="partnumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="serialnumber" class="form-label">Serial Number</label>
                            <input type="text" class="form-control fs-3" id="serialnumber" name="serialnumber" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?= $this->endSection(); ?>