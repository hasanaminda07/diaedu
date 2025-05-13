<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Selamat Datang <?= $user['name'] ?></h1>
                                <p>Selamat menggunakan DiaEdu</p>
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
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="row row-cols-1">
                    <div class="overflow-hidden d-slider1 ">
                        <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                            <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="<?= base_url('assets/'); ?>images/dashboard/blog.png" style="width:20%">
                                        <div class="progress-detail">
                                            <p class="mb-2">Gula Darah Terakhir</p>
                                            <h4 class="counter"><?= $gula['guladarah'] ?? 0 ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
            </div>

            <style>
                .card-zoom img {
                    transition: transform 0.3s ease-in-out;
                }

                .card-zoom:hover img {
                    transform: scale(1.2);
                }
            </style>
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-zoom" data-aos="fade-up" data-aos-delay="800">
                            <a href="<?= base_url('apps/dem/artikel_list') ?>" style="width: 100%;">
                                <div class="card-body">
                                    <center>
                                        <img src="<?= base_url('assets/'); ?>images/dashboard/1.png" style="width:60%">
                                    </center>

                                    <br>
                                    <center>
                                        <h5>Edukasi</h5>
                                    </center>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-zoom" data-aos="fade-up" data-aos-delay="800">
                            <a href="<?= base_url('apps/dem/guladarah_list') ?>" style="width: 100%;">
                                <div class="card-body">
                                    <center>
                                        <img src="<?= base_url('assets/'); ?>images/dashboard/blog.png" style="width:60%">
                                    </center>

                                    <br>
                                    <center>
                                        <h5>Gula Darah</h5>
                                    </center>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-zoom" data-aos="fade-up" data-aos-delay="800">
                            <a href="<?= base_url('apps/dem/chat_list') ?>" style="width: 100%;">
                                <div class="card-body">
                                    <center>
                                        <img src="<?= base_url('assets/'); ?>images/dashboard/3.png" style="width:60%">
                                    </center>

                                    <br>
                                    <center>
                                        <h5>Chat</h5>
                                    </center>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>