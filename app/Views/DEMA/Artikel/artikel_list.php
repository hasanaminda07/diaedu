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
                                <a href="<?= base_url('apps/dema') ?>">Dashboard</a> / Edukasi</p>
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
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <a href="<?= base_url('apps/dema/artikel_add_form') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus" style="margin-right:5px"></i>Tambah Artikel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-sm table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diubah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($artikel as $art) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $art['judul'] ?></td>
                                            <td><?= $art['kategori'] ?></td>
                                            <td><?= $art['created_by'] ?></td>
                                            <td> <?= date("d/m/Y H:i", strtotime($art['created_date'])); ?></td>
                                            <td> <?= date("d/m/Y H:i", strtotime($art['modified_date'])); ?></td>
                                            <td>
                                                <center>
                                                    <form action="<?= base_url('apps/dema/artikel_update_form') ?>" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $art['id'] ?>">
                                                        <button type="submit" class="btn btn-primary btn-sm" style="margin:3px; width:50px;"><i class="fa fa-edit"></i></button>
                                                    </form>


                                                    <form action="<?= base_url('apps/dema/artikel_delete_control') ?>" id="deleteForm" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $art['id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm" style="margin:5px; width:50px;" onclick="confirmDelete()"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <script>
                                                        function confirmDelete() {
                                                            Swal.fire({
                                                                title: "Apakah anda yakin?",
                                                                text: "Penghapusan edukasi ini akan dilakukan secara permanen dan tidak dapat dipulihkan",
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