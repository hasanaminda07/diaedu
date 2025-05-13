<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Kelola Akun</h1>
                                <?php if ($user['role_id'] == 1) { ?>
                                    <a href="<?= base_url('apps/dema') ?>">Dashboard</a> / Kelola Akun</p>
                                <?php } else { ?>
                                    <a href="<?= base_url('apps/dem') ?>">Dashboard</a> / Kelola Akun</p>
                                <?php } ?>
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

            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <img src="<?= base_url('assets/'); ?>images/avatars/logologin.png" alt="profile-pic" class="theme-color-default-img profile-pic rounded avatar-100">
                                <div class="header-title">
                                    <br>
                                    <h4 class="card-title"><?= $user['name'] ?></h4>
                                    <?= $user['username'] ?>
                                    <br>
                                    <form action="<?= base_url('apps/profile/ganti_tema') ?>" style="margin:3px" method="POST" class="d-inline-block">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="theme" value="dark">
                                        <button type="submit" style="margin-top:10px;" class="btn btn-border <?= ($user['theme'] == 'dark') ? 'active' : '' ?>"><i class="fa-solid fa-moon" style="margin-right:5px"></i> Dark</button>
                                    </form>
                                    <form action="<?= base_url('apps/profile/ganti_tema') ?>" style="margin:3px" method="POST" class="d-inline-block">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="theme" value="light">
                                        <button type="submit" style="margin-top:10px;" class="btn btn-border <?= ($user['theme'] == 'light') ? 'active' : '' ?>"><i class="fa-solid fa-sun" style="margin-right:5px"></i> Light</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Informasi Akun</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <form class="row g-3 needs-validation" action="<?= base_url('apps/profile/profile_update_control') ?>" method="POST" novalidate>
                                <?= csrf_field(); ?>

                                <div class="form-row">

                                    <div class="form-group col-md-12">
                                        <input type="text" name="name" class="form-control form-control-sm " id="validationCustom03" placeholder="Nama" value="<?= $user['name'] ?>" required>
                                        <div class="invalid-feedback">
                                            Harap Isi Nama Anda
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6" id="passhidden2">
                                    <input type="password" class="form-control form-control-sm" placeholder="Password" id="password1" name="password1" required>
                                    <div class="invalid-feedback">Harap Isi Password</div>
                                </div>

                                <div class="form-group col-md-6" id="passhidden3">
                                    <input type="password" class="form-control form-control-sm" placeholder="Konfirmasi Password" id="password2" name="password2" required>
                                    <div class="invalid-feedback">Harap Isi konfirmasi Password</div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox" id="check" name="check" value="1"> Ganti Password
                                    </label>
                                </div>

                                <input type='hidden' name='id' value="<?= $user['id'] ?>">

                                <div class="d-inline">
                                    <button type="submit" class="btn btn-icon-split btn-primary btn-sm " style="float: right; margin-left:5px;">
                                        <span class="icon text-white"><i class="fas fa-save" style="margin-right: 5px;"></i></span>
                                        <span class="text">Simpan</span>
                                    </button>
                            </form>

                            <form id="deleteForm" action="<?= base_url('apps/dema/delete_user') ?>" method="POST" novalidate>
                                <button type="button" class="btn btn-icon-split btn-danger btn-sm" style="float: right" onclick="confirmDelete()">
                                    <span class="icon text-white">
                                        <i class="fas fa-trash" style="margin-right: 5px;"></i>
                                    </span>
                                    <span class="text">Hapus Akun</span>
                                </button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    </div>





    </div>
    </div>
    <script>
        const checkCheckbox = document.getElementById('check');
        const passhidden2 = document.getElementById('passhidden2');
        const passhidden3 = document.getElementById('passhidden3');
        const password1 = document.getElementById('password1');
        const password2 = document.getElementById('password2');

        passhidden2.style.display = 'none';
        passhidden3.style.display = 'none';
        password1.removeAttribute('required');
        password2.removeAttribute('required');

        checkCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passhidden2.style.display = 'block';
                passhidden3.style.display = 'block';
                password1.setAttribute('required', 'true');
                password2.setAttribute('required', 'true');
            } else {
                passhidden2.style.display = 'none';
                passhidden3.style.display = 'none';
                password1.removeAttribute('required');
                password2.removeAttribute('required');
            }
        });

        function confirmDelete() {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Penghapusan akun ini akan dilakukan secara permanen dan tidak dapat dipulihkan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "red",
                cancelButtonColor: "#000000",
                confirmButtonText: "Hapus", // Tambahkan koma di sini
                cancelButtonText: "Batal",
                reverseButtons: true // Membalik posisi tombol (Hapus ke kanan, Batal ke kiri)
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm").submit(); // Submit form setelah konfirmasi
                }
            });
        }
    </script>