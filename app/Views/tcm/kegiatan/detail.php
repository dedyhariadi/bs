<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">


  <!-- awal toast (informasi sukses dari halaman sebelumnya) -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="toast position-fixed bottom-50 end-50 p-0" data-bs-delay="2000" role="alert" aria-live="polite" aria-atomic="true">
      <div class="toast-header bg-success text-white">
        <strong class="me-auto">Sukses</strong>
        <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        <?= session()->getFlashdata('success'); ?>
      </div>
    </div>

  <?php elseif (session()->getFlashdata('error')): ?>
    <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-danger text-white">
        <strong class="me-auto">Gagal</strong>
        <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        <?= session()->getFlashdata('error'); ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- akhir toast -->


  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
    <h1 class="h2">Torpedo Countermeasure</h1>
  </div>



  <div class="text-center fw-bold fs-2 mt-4 mb-2">
    Detail Kegiatan
    <?= $kegiatan['jenisGiat'] ?>
  </div>


  <div class="row my-3 fs-3">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3 fs-4">
        <div class="card-body">
          <h5 class="card-title">Tanggal Pelaksanaan :</h5>
          <p class="card-text"><?= tampilTanggal($kegiatan['tglPelaksanaan']); ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5 class="card-title">Transfer Dari :</h5>
          <p class="card-text"><?= array_column($satkai, 'satkai', 'id')[$kegiatan['transferDariId']] ?? ''; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Transfer Ke :</h5>
          <p class="card-text"><?= array_column($satkai, 'satkai', 'id')[$kegiatan['transferKeId']] ?? ''; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-black bg-warning mb-3">
        <div class="card-body">
          <h5 class="card-title">Dasar Surat :</h5>
          <p class="card-text"><?= array_column($surat, 'noSurat', 'id')[$kegiatan['suratId']] ?? ''; ?></p>
        </div>
      </div>
    </div>
  </div>
  <?= anchor('tcm/kegiatan', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-4']); ?>

  <div class="row mt-3">
    <div class="col-12">
      <div class="card text-black mb-3" style="background-color: #F7FFF7;">
        <div class="card-body">

          <table class="table table-hover fs-5">
            <thead>
              <tr class="text-center align-middle">
                <th scope="col">#</th>
                <th scope="col">ITEM</th>
                <th scope="col">PART NUMBER</th>
                <th scope="col">SERIAL NUMBER</th>
                <th scope="col">KONDISI</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($tcm as $item) : ?>
                <tr class="align-middle">
                  <th scope="row" class="text-center"><?= $no++; ?></th>
                  <td class="text-start"><?= $item['jenisTcm']; ?></td>
                  <td class="text-start"><?= $item['partNumber']; ?></td>
                  <td class="text-start"><?= $item['serialNumber']; ?></td>
                  <td class="text-center"><?= $item['kondisi']; ?></td>
                  <td class="text-center">

                    <?= form_open('tcm/' . $item['id'], '', ['_method' => 'DELETE', 'class' => 'form-control', 'kegiatanId' => $kegiatan['id'], 'trxtcmId' => $item['idTrxTcm']]); ?>


                    <?= form_button([
                      'class'   => 'btn btn-outline-danger d-inline',
                      'type'    => 'submit',
                      'content' => '<i class="bi bi-x-lg"></i>',
                      'onclick' => "return confirm('Apakah anda yakin menghapus ini?');"
                    ]); ?>

                    <?= form_close(); ?>



                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <th scope="row"></th>
                <td class="text-start pt-4 ps-5 fw-bold" colspan="7">

                  <?php

                  if ($kegiatan['jenisGiat'] == "Barang Masuk") {
                  ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTcmModal">
                      Add TCM
                    </button>
                  <?php } else { ?>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addTrxTcmModal">
                      Add TCM
                    </button>
                  <?php } ?>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <?php
  if ($kegiatan['keterangan'] !== '') {
  ?>
    <div class="row">
      <div class="col-6">
        <div class="card text-black mb-3 fs-4" style="background-color: #e9f8e9ff;">
          <div class="card-body">
            <h5 class="card-title">KETERANGAN :</h5>
            <p class="card-text"><?= $kegiatan['keterangan']; ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php
  } ?>

  <!-- Add Tcm Barang Masuk Modal -->
  <div class="modal modal-lg" id="addTcmModal" tabindex="-1" aria-labelledby="addTcmModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addTcmModal">TCM Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= form_open('tcm', '', ['kegiatanId' => $kegiatan['id'], 'posisiId' => $kegiatan['transferKeId'], 'jenisGiat' => 'barangMasuk']); ?>

          <div class="form-floating mb-5">
            <?php
            echo form_dropdown('jenisTcm', array_column($jenisTcm, 'nama', 'id'), ' ', ['class' => 'form-select fs-2', 'required' => 'required', 'autocomplete' => 'off', 'style' => 'height: 80px;']);
            echo form_label('Jenis TCM', 'jenisTcm', ['class' => 'form-label fs-5']);
            ?>
          </div>


          <div class="form-floating mb-5">
            <?= form_input('partNumber', '', ['class' => 'form-control fs-3', 'id' => 'partNumber', 'placeholder' => 'Part Number', 'style' => 'height:80px']) ?>
            <?= form_label('Part Number', 'partNumber'); ?>
          </div>

          <div class="form-floating mb-5">
            <?= form_input('serialNumber', '', ['class' => 'form-control fs-3', 'style' => 'height: 80px;', 'id' => 'serialNumber', 'placeholder' => 'Serial Number']) ?>
            <?= form_label('Serial Number', 'serialNumber', ['class' => 'form-label',]); ?>
          </div>

          <div class="mb-5">
            <?= form_label('Kondisi :', 'kondisi', ['class' => 'form-label ms-2 me-5 fs-4']); ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio1" value="OK" checked>
              <label class="form-check-label" for="inlineRadio1">OK</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="kondisi" id="inlineRadio2" value="Not OK">
              <label class="form-check-label" for="inlineRadio2">Not Ok</label>
            </div>
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


  <!-- Add Tcm Selain Barang Masuk Modal -->
  <div class="modal modal-lg" id="addTrxTcmModal" tabindex="-1" aria-labelledby="addTrxTcmModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addTrxTcmModal">TCM Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= form_open('tcm', '', ['kegiatanId' => $kegiatan['id'], 'posisiId' => $kegiatan['transferKeId'], 'jenisGiat' => 'nonBarangMasuk']); ?>

          <div class="card">
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Part Number</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col" class="text-center">Kondisi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php
                  $jumlahTcmByPosisi = count($tcmByPosisi);
                  echo $jumlahTcmByPosisi > 0 ? '' : '<tr><td colspan="6" class="text-start text-primary text-uppercase">Tidak ada TCM yang tersedia di ' . array_column($satkai, 'satkai', 'id')[$kegiatan['transferDariId']] . '</td></tr>';
                  foreach ($tcmByPosisi as $index => $item) :
                  ?>
                    <tr>
                      <th scope="row"><?= $index + 1; ?></th>
                      <td>
                        <?php
                        foreach ($jenisTcm as $j):
                          echo ($item['jenisId'] == $j['id']) ? $j['nama'] : '';
                        endforeach;
                        ?>
                      </td>
                      <td><?= $item['partNumber']; ?></td>
                      <td><?= $item['serialNumber']; ?></td>
                      <td>
                        <div class="form-check-inline">
                          <input class="form-check-input" type="radio" name="kondisi<?= $item['id'] ?>" value="OK" id="radioDefault1<?= $item['id'] ?>" <?= $item['kondisi'] == 'OK' ? 'checked' : '' ?>>
                          <label class="form-check-label" for="radioDefault1<?= $item['id'] ?>">
                            OK
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <input class="form-check-input" type="radio" name="kondisi<?= $item['id'] ?>" value="NOT OK" id="radioDefault2<?= $item['id'] ?>" <?= $item['kondisi'] !== 'OK' ? 'checked' : '' ?>>
                          <label class="form-check-label" for="radioDefault2<?= $item['id'] ?>">
                            NOT OK
                          </label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" name="pilih[]" value="<?= $item['tcmId'] ?>">
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="text-end mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>

          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>


</main>


<script>
  window.existingTcmIds = <?= json_encode(array_column($tcm, 'id')); ?>;
</script>
<?= $this->endSection(); ?>