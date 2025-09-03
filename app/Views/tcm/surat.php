<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">


  <!-- awal toast (informasi sukses dari halaman sebelumnya) -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
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



  <div class="text-center fw-bold fs-2 mt-4 mb-5">
    SURAT
  </div>


  <div class="row">
    <div class="col-12">
      <div class="card rounded-4">
        <div class="card-body">

          <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
            <thead>
              <tr class="text-center align-middle">
                <th scope="col" rowspan="2">#</th>
                <th scope="col" rowspan="2">NO. SURAT</th>
                <th scope="col" rowspan="2">TANGGAL SURAT</th>
                <th scope="col" rowspan="2">PEJABAT</th>
                <th scope="col" rowspan="2">PERIHAL</th>
                <th scope="col"></th>
              </tr>

            <tbody>
              <?php foreach ($surat as $index => $item): ?>
                <tr class="fs-4">
                  <td scope="row" class="text-center"><?= $index + 1; ?></td>
                  <th class="ps-5 text-uppercase"><?= $item['noSurat']; ?></th>
                  <td class="text-start ms-2"> <?= tampilTanggal($item['tglSurat']); ?></td>
                  <td class="text-center"> <?= $item['pejabat']; ?></td>
                  <td class="text-start ms-1"> <?= $item['perihal']; ?></td>
                  <td>

                    <?= form_open('tcm/surat/' . $item['id'], '', ['_method' => 'DELETE', 'class' => 'form-control']); ?>

                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSuratModal<?= $item['id']; ?>"> <i class="bi bi-pen-fill"></i>
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
                    Add Surat
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Add Surat Modal -->
  <div class="modal modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Surat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <?= form_open_multipart('tcm/surat', ['class' => 'form-control']); ?>

          <div class="mb-3">
            <?= form_label('No Surat', 'noSurat', ['class' => 'form-label']); ?>
            <?= form_input('noSurat', '', ['class' => 'form-control fs-2', 'required' => 'required', 'autocomplete' => 'off']); ?>
          </div>

          <div class="mb-3">
            <?= form_label('Tanggal Surat', 'tglSurat', ['class' => 'form-label']); ?>
            <?= form_input('tglSurat', '', ['class' => 'form-control fs-2 tanggal-input', 'required' => 'required', 'autocomplete' => 'off']); ?>
          </div>

          <div class="mb-3">
            <?= form_label('Pejabat', 'pejabat', ['class' => 'form-label']); ?>
            <?= form_input('pejabat', '', ['class' => 'form-control fs-2', 'required' => 'required', 'autocomplete' => 'off']); ?>
          </div>

          <div class="form-floating mb-4">
            <textarea class="form-control fs-3" placeholder="Leave a comment here" id="perihal" style="height: 100px" name="perihal"></textarea>
            <label for="perihal">Perihal</label>
          </div>

          <div class="mb-3">
            <?= form_label('File PDF', 'filePdf', ['class' => 'form-label']); ?>
            <?= form_upload('filePdf', '', ['class' => 'form-control fs-5', 'autocomplete' => 'off']); ?>
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

  <!-- Edit Surat Modal -->
  <?php
  foreach ($surat as $item):
    // Modal untuk setiap item jika diperlukan
  ?>
    <div class="modal modal-lg" id="editSuratModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="editSuratModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editSuratModalLabel">Edit Surat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <?= form_open_multipart('tcm/surat/' . $item['id'], '', ['class' => 'form-control', '_method' => 'PUT']); ?>

            <div class="mb-3">
              <?= form_label('No Surat', 'noSurat', ['class' => 'form-label']); ?>
              <?= form_input('noSurat', $item['noSurat'], ['class' => 'form-control fs-2', 'required' => 'required', 'autocomplete' => 'off']); ?>
            </div>

            <div class="mb-3">
              <?= form_label('Tanggal Surat', 'tglSurat', ['class' => 'form-label']); ?>
              <?= form_input('tglSurat', tampilTanggal($item['tglSurat']), ['class' => 'form-control fs-2 tanggal-input', 'required' => 'required', 'autocomplete' => 'off']); ?>
            </div>

            <div class="mb-3">
              <?= form_label('Pejabat', 'pejabat', ['class' => 'form-label']); ?>
              <?= form_input('pejabat', $item['pejabat'], ['class' => 'form-control fs-2', 'required' => 'required', 'autocomplete' => 'off']); ?>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control fs-3" placeholder="Leave a comment here" id="perihal" style="height: 100px" name="perihal"><?= $item['perihal'] ?></textarea>
              <label for="perihal">Perihal</label>
            </div>

            <div class="mb-3">
              <?= form_label('File PDF', 'filePdf', ['class' => 'form-label']); ?>
              <?= form_upload('filePdf', '', ['class' => 'form-control fs-5', 'autocomplete' => 'off']); ?>
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

</main>



<?= $this->endSection(); ?>