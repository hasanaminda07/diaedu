<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Akun</h1>
                                <a href="<?= base_url('apps/dema') ?>">Dashboard</a> / Akun</p>
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
                        <div class="table-responsive">
                            <table id="datatable" class="table table-sm table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($akun as $akn) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $akn['name'] ?></td>
                                            <td><?= $akn['username'] ?></td>

                                            <td>
                                                <center>


                                                    <form action="<?= base_url('apps/dema/akun_delete_control') ?>" id="deleteForm" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $akn['id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm" style="margin:5px; width:50px;" onclick="confirmDelete()"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <script>
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
                                                </center>
                                            </td>

                                        </tr>
                                    <?php } ?>


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>