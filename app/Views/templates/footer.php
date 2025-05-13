<div class="btn-download" id="myBtn" style="position: fixed; bottom: 20px; right: 20px; opacity: 0; visibility: hidden; transition: opacity 0.5s ease, visibility 0.5s ease;" onclick="topFunction()">
    <a class="btn btn-primary px-3 py-2">
        <i class="fas fa-angle-up"></i>
    </a>
</div>

<script>
    let mybutton = document.getElementById("myBtn");

    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.opacity = "0.9";
            mybutton.style.visibility = "visible";
        } else {
            mybutton.style.opacity = "0";
            setTimeout(() => {
                if (mybutton.style.opacity === "0") {
                    mybutton.style.visibility = "hidden";
                }
            }, 500); // Sesuai dengan transition: opacity 0.5s
        }
    }

    function topFunction() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
</script>
<!-- Footer Section Start -->
<footer class="footer">
    <div class="footer-body">
        <ul class="left-panel list-inline mb-0 p-0">

        </ul>
        <div class="right-panel">
            ©<script>
                document.write(new Date().getFullYear())
            </script> DiaEdu
        </div>
    </div>
</footer>
<!-- Footer Section End -->
</main>

<!-- Wrapper End-->
<!-- offcanvas start -->

<script>
    var currentPage = window.location.href;

    var menuLinks = document.querySelectorAll('.nav-link');

    for (var i = 0; i < menuLinks.length; i++) {
        if (menuLinks[i].href === currentPage) {
            menuLinks[i].classList.add('active');
        }
    }
</script>
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
<script src="<?= base_url('assets/'); ?>vendor/aos/dist/aos.js"></script>

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
                showConfirmButton: false,
                timer: 2000
            }) <?php
            } ?>
    });
</script>

</body>

</html>