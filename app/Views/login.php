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
   </div>
   <!-- loader END -->

   <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">
            <div class="col-md-6">
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">

                           </a>
                           <center>
                              <img src="<?= base_url('assets/'); ?>/images/logo.png"
                                 style="width:150px; margin-bottom:20px; ">
                           </center>
                           <form method="post" action="<?= base_url('auth') ?> " id="myForm">
                              <?= csrf_field(); ?>
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <input type="email" class="form-control" placeholder="Email" id="username1" required>
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <button type="button" id="togglePassword" class="toggle-password-btn">
                                          <i class="fas fa-eye-slash"></i>
                                       </button>
                                       <input type="password" placeholder="Password" class="form-control" id="password1" required>

                                    </div>
                                 </div>

                              </div>


                              <input type="hidden" name="c#6*a" id="password">
                              <input type="hidden" name="dax#$^" value="1E#">
                              <input type="hidden" name="a1=35%" id="username">
                              <input type="hidden" name="bc#&" value="4=1#">
                              <input type="hidden" name="1dt&x" value="841#">

                              <div class="d-flex justify-content-center">
                                 <button type="submit" class="btn btn-primary" onclick="encryptAndSubmit()" style="width: 100%;">Masuk</button>
                              </div>

                              <p class="mt-3 text-center">
                                 Belum punya akun ? <a href="<?= base_url('daftar') ?>" class="text-underline">Daftar Sekarang</a>
                                 <br>
                                 <a href="<?= base_url('reset') ?>">Lupa Password</a>
                              </p>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
            <div class=" col-md-6 d-md-block d-none  p-0 mt-n1 vh-100 overflow-hidden">
               <img src="<?= base_url('assets/'); ?>images/auth/bg.png" class="img-fluid gradient-main animated-scaleX"
                  alt="images">
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

</body>

</html>


<script>
   function encryptAndSubmit() {
      var username = document.getElementById("username1").value;
      var password = document.getElementById("password1").value;


      // Lakukan enkripsi di sini, contoh sederhana menggunakan btoa()
      var encryptedUsername = btoa(username);
      var encryptedPassword = btoa(password);


      // Set nilai enkripsi ke input tersembunyi
      document.getElementById("username").value = encryptedUsername;
      document.getElementById("password").value = encryptedPassword;

      // Submit form
      document.getElementById("loginForm").submit();
   }
</script>
<script>
   document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordField = document.getElementById('password1');
      const passwordFieldType = passwordField.getAttribute('type');
      const newPasswordFieldType = passwordFieldType === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', newPasswordFieldType);

      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye-slash');
      icon.classList.toggle('fa-eye');

      // Toggle class to change color
      this.classList.toggle('active');
   });
</script>

<script>
   $(function() {

      <?php
      if (session()->has("message") && session()->has("icon")) { ?>
         Swal.fire({
            icon: '<?= session("icon") ?>',
            title: '<?= session("title") ?>',
            text: '<?= session("message") ?>',
            timer: 2000
         }) <?php
         } ?>
   });
</script>