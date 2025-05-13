<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="#" class="navbar-brand">
            <!--Logo start-->
            <!--logo End-->

            <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <center>
                        <img src="<?= base_url('assets/'); ?>images/logo.png" style="width:40px">
                    </center>
                </div>

            </div>
            <!--logo End-->
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
            </i>
        </div>
        <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">


            <li class="nav-item dropdown">
                <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="caption ms-3 d-none d-md-block " style="margin-right:20px">
                        <h6 class="mb-0 caption-title text-end"><?= $user['name'] ?></h6>
                        <p class="mb-0 caption-sub-title text-end"><?php if ($user['role_id'] == 1) {
                                                                        echo "Administrator";
                                                                    } elseif ($user['role_id'] == 2) {
                                                                        echo "User";
                                                                    } ?></p>
                    </div>
                    <img src="<?= base_url('assets/'); ?>images/avatars/logologin.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">


                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('apps/profile') ?>">Kelola Akun</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('auth/lo') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav> <!-- Nav Header Component Start -->