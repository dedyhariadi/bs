<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">





  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
    <h1 class="h2">Torpedo Countermeasure</h1>
  </div>



  <div class="text-center fw-bold fs-2 mt-4 mb-5">
    LOKASI
  </div>


  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="card rounded-4">
        <div class="card-body">

          <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
            <thead>
              <tr class="text-center align-middle">
                <th scope="col" rowspan="2">#</th>
                <th scope="col" rowspan="2">LOKASI</th>
                <th scope="col" rowspan="2">BANYAK</th>
                <th scope="col"></th>
              </tr>

            <tbody>
              <?php foreach ($satkai as $index => $item): ?>
                <tr class="fs-4">
                  <td scope="row" class="text-center"><?= $index + 1; ?></td>
                  <th class="ps-5 text-uppercase"><?= $item['satkai']; ?></th>
                  <td class="text-center">
                    <?php
                    $jumlahTcm = 0;
                    foreach ($satkaiFill as $fill) {
                      if ($fill['id'] == $item['id']) {
                        $jumlahTcm = $fill['tcmCount'];
                        break;
                      }
                    }
                    echo $jumlahTcm;
                    ?>
                    &nbsp;Unit</td>
                  <td>

                    <?= form_open('tcm/satkai/' . $item['id'], '', ['_method' => 'DELETE', 'class' => 'form-control']); ?>

                    <?= anchor('tcm/satkai/' . $item['id'], '<i class="bi bi-zoom-in"></i>', ['class' => 'btn btn-outline-success']); ?> &nbsp;


                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSatkaiModal<?= $item['id']; ?>"> <i class="bi bi-pen-fill"></i>
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
                    Add Satkai
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Add Satkai Modal -->
  <div class="modal modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Satkai</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= form_open('tcm/satkai'); ?>
          <div class="mb-5">
            <?= form_label('Nama', 'satkai', ['class' => 'form-label']); ?>
            <?= form_input('nama', '', ['class' => 'form-control fs-2', 'required' => 'required', 'autocomplete' => 'off']); ?>
          </div>
          <div class="mb-3">
            <?php
            echo form_label('Jenis', 'jenis', ['class' => 'form-label']);

            $pilihan = [
              'Arsenal' => 'Arsenal',
              'Surface Ship' => 'Surface Ship',
              'Submarines' => 'Submarines'
            ];
            echo form_dropdown('jenis', $pilihan, '', ['class' => 'form-select fs-2', 'required' => 'required']);
            ?>

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

  <!-- Edit Satkai Modal -->
  <?php
  foreach ($satkai as $item):
    // Modal untuk setiap item jika diperlukan
  ?>
    <div class="modal modal-lg" id="editSatkaiModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="editSatkaiModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editSatkaiModalLabel">Edit Satkai</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?= form_open('tcm/satkai/' . $item['id'], '', ['_method' => 'PUT', 'class' => 'form-control']); ?>
            <div class="mb-5">
              <?= form_label('Nama', 'satkai', ['class' => 'form-label']); ?>
              <?= form_input('nama', $item['satkai'], ['class' => 'form-control fs-2', 'required' => 'required', 'autocomplete' => 'off']); ?>
            </div>
            <div class="mb-3">
              <?php
              echo form_label('Jenis', 'jenis', ['class' => 'form-label']);

              $pilihan = [
                'Arsenal' => 'Arsenal',
                'Surface Ship' => 'Surface Ship',
                'Submarines' => 'Submarines'
              ];
              echo form_dropdown('jenis', $pilihan, $item['jenis'], ['class' => 'form-select fs-2', 'required' => 'required']);
              ?>

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
  <?php
  endforeach;
  ?>

  <!-- List TCM tiap Satkai Modal -->

  <?php
  foreach ($satkai as $item):
  ?>
    <div class="modal modal-lg" id="addTrxTcmModal" tabindex="-1" aria-labelledby="addTrxTcmModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addTrxTcmModal">List TCM</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

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
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <?php
                    $jumlahTcmByPosisi = count($tcmIds);
                    echo $jumlahTcmByPosisi > 0 ? '' : '<tr><td colspan="6" class="text-start text-primary text-uppercase">Tidak ada TCM yang tersedia di ' . $item['satkai'] . '</td></tr>';
                    foreach ($tcmIds as $index => $itemTcm) :
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
              <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
            </div>

            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

</main>



<?= $this->endSection(); ?>