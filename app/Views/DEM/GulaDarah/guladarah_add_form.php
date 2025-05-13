<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Tambah Gula Darah</h1>
                                <a href="<?= base_url('apps/dem') ?>">Dashboard</a> / <a href="<?= base_url('apps/dem/guladarah_list') ?>">Gula Darah</a> / Tambah Gula Darah</p>
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
                        <form class="row g-3 needs-validation" action="<?= base_url('apps/dem/guladarah_add_control') ?>" method="POST" novalidate>
                            <?= csrf_field(); ?>
                            <div class="col-md-12">
                                <input type="text" name="guladarah" class="form-control form-control-sm " placeholder="Gula Darah" required>
                                <div class="invalid-feedback">
                                    Harap Isi Gula Darah Anda
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="date" name="tanggal" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" required>
                                <div class="invalid-feedback">
                                    Harap Isi Tanggal
                                </div>
                            </div>



                            <div class="d-inline">
                                <button type="submit" class="btn btn-icon-split btn-primary btn-sm " style="float: right; margin-left:5px;">
                                    <span class="icon text-white"><i class="fas fa-save" style="margin-right: 5px;"></i></span>
                                    <span class="text">Simpan</span>
                                </button>

                                <a href="<?= base_url('sisgo/admin/user_m_list'); ?>">
                                    <button type="button" class="btn btn-icon-split btn-secondary btn-sm" style="float: right">
                                        <span class="icon text-white"><i class="fas fa-undo-alt" style="margin-right: 5px;"></i></span>
                                        <span class="text">Kembali</span>
                                    </button>
                                </a>

                            </div>
                        </form>



                    </div>


                </div>
            </div>
        </div>
    </div>

    </div>
    </div>