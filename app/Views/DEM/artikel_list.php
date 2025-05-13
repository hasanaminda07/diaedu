<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Edukasi</h1>
                                <a href="<?= base_url('apps/dem') ?>">Dashboard</a> / Edukasi</p>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="<?= base_url('assets/'); ?>images/dashboard/top-image.jpg" style="filter: blur(8px);-webkit-filter: blur(8px);" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            </div>
        </div> <!-- Nav Header Component End -->
        <!--Nav End-->
    </div>






    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row" data-aos="fade-up" data-aos-delay="700">
            <?php
            foreach ($artikel as $art) { ?>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div style="width:100%">
                                <?php
                                // Ambil hanya tag <img> dari $art['banner']
                                preg_match('/<img.*?src=["\'](.*?)["\'].*?>/i', $art['banner'], $matches);

                                // Jika ditemukan gambar, tampilkan
                                if (!empty($matches[1])) {
                                    echo '<img src="' . htmlspecialchars($matches[1]) . '" style="max-width:100%; height:auto;">';
                                }
                                ?>
                            </div>

                            <br>
                            <h4 style="margin-bottom:1px"><?= $art['judul'] ?></h4><?= $art['kategori'] ?> | <?= date("d/m/Y H:i", strtotime($art['created_date'])); ?>
                            <br><br><a href="<?= base_url('apps/dem/artikel_detail/' . base64_encode($art['id'])) ?>" class="btn btn-primary btn-sm">Baca Lebih Lanjut</a>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links('artikel_pagination', 'bootstrap_pagination') ?>
            </div>

        </div>

    </div>
    </div>