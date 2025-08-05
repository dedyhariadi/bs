<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">Torpedo Counter Measure</h2>
    </div>

    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addTransaksiModal">
        add TCM
    </button>

    <div class="accordion mt-3" id="accordionPanelsStayOpenExample">
        <?php
        foreach ($jenis as $item) :
        ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#panelsStayOpen-collapse' . $item['id']; ?>" aria-expanded="true" aria-controls="<?= 'panelsStayOpen-collapse' . $item['id']; ?>">
                        <?= $item['nama']; ?>
                    </button>
                </h2>
                <div id="<?= 'panelsStayOpen-collapse' . $item['id']; ?>" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the first item’s accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
    <br><br>




    <?= $this->endSection(); ?>