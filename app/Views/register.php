<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DiaEdu</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>/images/logo.png" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/core/libs.min.css" />


    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/hope-ui.min.css?v=2.0.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/custom.min.css?v=2.0.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/rtl.min.css" />



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Sweet Alret -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.16.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.16.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <center>
                <div class="loader-body"> <img src="<?= base_url('assets/'); ?>images/loader.gif" style="width:200px">
            </center>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="<?= base_url('assets/'); ?>images/auth/bg2.png" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                                <div class="card-body">

                                    <h2 class="mb-2 text-center">Daftar</h2>
                                    <p class="text-center">Buat Akunmu dan Rasakan Kemudahannnya</p><br>
                                    <form class="row g-3 needs-validation" action="<?= base_url('daftar') ?>" method="POST" novalidate>
                                        <?= csrf_field(); ?>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control form-control-sm " placeholder="Nama" value="<?= set_value('name') ?>" required>
                                                    <div class="invalid-feedback">
                                                        Harap Isi Nama Anda
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="email" name="username" class="form-control form-control-sm " placeholder="Email" value="<?= set_value('username') ?>" required>
                                                    <div class="invalid-feedback">
                                                        Harap Isi Email Anda
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="password" name="password1" class="form-control form-control-sm " placeholder="Password" required>
                                                    <div class="invalid-feedback">
                                                        Harap Isi Password Anda
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="password" name="password2" class="form-control form-control-sm " placeholder="Konfirmasi Password" required>
                                                    <div class="invalid-feedback">
                                                        Harap Isi Konfirmasi Password Anda
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar</button>
                                        </div>

                                        <p class="mt-3 text-center">
                                            Sudah punya akun ? <a href="<?= base_url('') ?>" class="text-underline">Masuk</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Library Bundle Script -->
    <script src="<?= base_url('assets/'); ?>js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="<?= base_url('assets/'); ?>js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="<?= base_url('assets/'); ?>js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="<?= base_url('assets/'); ?>js/charts/vectore-chart.js"></script>
    <script src="<?= base_url('assets/'); ?>js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="<?= base_url('assets/'); ?>js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="<?= base_url('assets/'); ?>js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="<?= base_url('assets/'); ?>js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="<?= base_url('assets/'); ?>js/plugins/form-wizard.js"></script>

    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="<?= base_url('assets/'); ?>js/hope-ui.js" defer></script>
    <script>
        $(function() {

            <?php
            if (session()->has("message") && session()->has("icon")) { ?>
                Swal.fire({
                    icon: '<?= session("icon") ?>',
                    title: '<?= session("title") ?>',
                    text: '<?= session("message") ?>',
                }) <?php
                } ?>
        });
    </script>

</body>

</html>