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
                                <a href="<?= base_url('apps/dem') ?>">Dashboard</a> / <a href="<?= base_url('apps/dem/artikel_list') ?>">Edukasi</a> / <?= $artikel['judul'] ?></p>
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <?php
                        // Ambil hanya tag <img> dari $artikel['banner']
                        preg_match('/<img.*?src=["\'](.*?)["\'].*?>/i', $artikel['banner'], $matches);

                        // Jika ditemukan gambar, tampilkan
                        if (!empty($matches[1])) {
                            echo '<img src="' . htmlspecialchars($matches[1]) . '" style="width:100%">';
                        } ?>

                        <br>
                        <br>
                        <h1><?= $artikel['judul'] ?></h1>
                        <?= $artikel['kategori'] ?> | <?= date("d/m/Y H:i", strtotime($artikel['created_date'])); ?>
                        <br>
                        <br>
                        <?= $artikel['konten'] ?>



                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>