<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Gula Darah</h1>
                                <a href="<?= base_url('apps/dem') ?>">Dashboard</a> / Gula Darah</p>
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
            <div class="col-sm-5">
                <div class="card">
                    <canvas style="margin:20px" id="gulaChart"></canvas>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <a href="<?= base_url('apps/dem/guladarah_add_form') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus" style="margin-right:5px"></i>Tambah Data Gula Darah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-sm table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th width="5%">Gula Darah</th>
                                        <th width="5%">Tanggal</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($gula as $gla) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $gla['guladarah'] ?></td>
                                            <td><?= date("d/m/Y", strtotime($gla['tanggal'])); ?></td>
                                            <td>
                                                <center>
                                                    <form action="<?= base_url('apps/dem/guladarah_update_form') ?>" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $gla['id'] ?>">
                                                        <button type="submit" class="btn btn-primary btn-sm" style="margin:3px; width:50px;"><i class="fa fa-edit"></i></button>
                                                    </form>


                                                    <form action="<?= base_url('apps/dem/guladarah_delete_control') ?>" id="deleteForm" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $gla['id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm" style="margin:5px; width:50px;" onclick="confirmDelete()"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <script>
                                                        function confirmDelete() {
                                                            Swal.fire({
                                                                title: "Apakah anda yakin?",
                                                                text: "Penghapusan data gula darah ini akan dilakukan secara permanen dan tidak dapat dipulihkan",
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ambil data dari PHP ke dalam JavaScript
        var gulaData = <?php
                        foreach ($gula as $key => $gla) {
                            // Format tanggal menjadi dd-mm-yyyy
                            $gula[$key]['tanggal'] = date("d-m-Y", strtotime($gla['tanggal']));
                        }
                        echo json_encode($gula);
                        ?>;

        // Pisahkan data menjadi label (tanggal) dan nilai gula darah
        var labels = gulaData.map(item => item.tanggal);
        var dataValues = gulaData.map(item => item.guladarah);

        // Konfigurasi Chart.js
        var ctx = document.getElementById('gulaChart').getContext('2d');
        var gulaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Gula Darah',
                    data: dataValues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Gula Darah'
                        },
                        beginAtZero: false
                    }
                }
            }
        });
    </script>