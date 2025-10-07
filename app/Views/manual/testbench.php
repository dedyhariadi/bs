<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manual Test Bench dan Alat Ukur</h1>
    </div>

    <div class="row g-4">
        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #2F4F4F;">
                <h5 class="card-header">MT41920013</h5>
                <div class="card-body">
                    <h2 class="card-title">VAS103B</h2>
                    <p class="card-text">Vand System</p>
                    <?= anchor('uploads/manualbook/MT41920013_VAS103B_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #6B8E23" ;>
                <h5 class="card-header">MT41920014</h5>
                <div class="card-body">
                    <h2 class="card-title">DTE103F</h2>
                    <p class="card-text">Dockyard Test Equipment</p>
                    <?= anchor('uploads/manualbook/MT41920014_DTE103F_Vol1_base_april_2020.pdf', 'Vol. 1', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                    <?= anchor('uploads/manualbook/MT41920014_DTE103F_Vol2_base_april_2020.pdf', 'Vol. 2', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #B8860B" ;>
                <h5 class="card-header">MT41920015</h5>
                <div class="card-body">
                    <h2 class="card-title">PTU103A</h2>
                    <p class="card-text">Portable Test Unit</p>
                    <?= anchor('uploads/manualbook/MT41920015_PTU103A_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #5A3E36 " ;>
                <h5 class="card-header">MT41920016</h5>
                <div class="card-body">
                    <h2 class="card-title">ADC101A</h2>
                    <p class="card-text">Arming Device Control</p>
                    <?= anchor('uploads/manualbook/MT41920016_ADC101A_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-3">
            <div class="card text-dark rounded-4 mb-4" style="background-color: #A3B18A;">
                <h5 class="card-header">MT41920017</h5>
                <div class="card-body">
                    <h1 class="card-title">SBT104B</h1>
                    <p class="card-text">Secondary Battery Test Equipment</p>
                    <?= anchor('uploads/manualbook/MT41920017_SBT104B_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #344E41 " ;>
                <h5 class="card-header">MT41920018</h5>
                <div class="card-body">
                    <h1 class="card-title">BDA103A</h1>
                    <p class="card-text">Battery Data Analysis</p>
                    <?= anchor('uploads/manualbook/MT41920018_BDA103A_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card rounded-4 text-dark mb-4" style="background-color: #DAD7CD " ;>
                <h5 class="card-header">MT41920019</h5>
                <div class="card-body">
                    <h1 class="card-title">TRS120A</h1>
                    <p class="card-text">Torpedo Simulator</p>
                    <?= anchor('uploads/manualbook/MT41920019_TRS120A_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #4D5947 " ;>
                <h5 class="card-header">MT41920020</h5>
                <div class="card-body">
                    <h1 class="card-title">TDA101J</h1>
                    <p class="card-text">Torpedo Data Analysis</p>
                    <?= anchor('uploads/manualbook/MT41920020_TDA101J_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">


        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #2E3A2F " ;>
                <h5 class="card-header">MT41920022</h5>
                <div class="card-body">
                    <h2 class="card-title">BAC112A</h2>
                    <p class="card-text">Battery Charger</p>
                    <?= anchor('uploads/manualbook/MT41920022_BAC112A_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-dark rounded-4 mb-4" style="background-color: #A3B18A;">
                <h5 class="card-header">MT41920025</h5>
                <div class="card-body">
                    <h2 class="card-title">Container</h2>
                    <p class="card-text">Torpedo</p>
                    <?= anchor('uploads/manualbook/MT41920025_Container_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-dark', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-dark rounded-4 mb-4" style="background-color: #A3B18A;">
                <h5 class="card-header">MT41920025</h5>
                <div class="card-body">
                    <h2 class="card-title">Container</h2>
                    <p class="card-text">Primary dan Secondary Battery</p>
                    <?= anchor('uploads/manualbook/MT41920025_Container_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-dark', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>


        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #5A3E36 " ;>
                <h5 class="card-header">MT41920024</h5>
                <div class="card-body">
                    <h2 class="card-title">RSM101B</h2>
                    <p class="card-text">Multi Pinger Detector</p>
                    <?= anchor('uploads/manualbook/MT41920024_RSM101B_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #B8860B" ;>
                <h5 class="card-header">MT41920023</h5>
                <div class="card-body">
                    <h1 class="card-title">CPA103A</h1>
                    <p class="card-text">Controllo Pinger e Antenna <br>(Pinger and Antenna Test Equipment)</p>
                    <?= anchor('uploads/manualbook/MT41920023_CPA103A_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #2E3A2F ;">
                <h5 class="card-header">MT41920021</h5>
                <div class="card-body">
                    <h1 class="card-title">ARL102B</h1>
                    <p class="card-text">Apparato Radio Localizzatore <br>(Radio Localizer Unit)
                    </p>
                    <?= anchor('uploads/manualbook/MT41920021_ARL102B_base_april_2020.pdf', 'Detail', ['class' => 'btn btn-outline-light', 'target' => '_blank']);
                    ?>
                </div>
            </div>
        </div>


    </div>

</main>

<?= $this->endSection(); ?>