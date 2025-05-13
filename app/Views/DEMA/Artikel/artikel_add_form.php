<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>Tambah Edukasi</h1>
                                <a href="<?= base_url('apps/dema') ?>">Dashboard</a> / <a href="<?= base_url('apps/dema/artikel_list') ?>">Edukasi</a> / Tambah Edukasi</p>
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




    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.2.0/ckeditor5.css">
    <meta name="csrf-token" content="<?= csrf_hash(); ?>">

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row" data-aos="fade-up" data-aos-delay="700">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="row g-3 needs-validation" action="<?= base_url('apps/dema/artikel_add_control') ?>" method="POST" novalidate>
                            <?= csrf_field(); ?>
                            <div class="col-md-12">
                                <input type="text" name="judul" class="form-control form-control-sm " id="validationCustom03" placeholder="Judul Artikel" required>
                                <div class="invalid-feedback">
                                    Harap Isi Judul
                                </div>
                            </div>
                            <div class="col-md-12">
                                <select name="kategori" class="form-control form-control-sm " id="validationCustom03" required>
                                    <option value="" disabled selected>Kategori</option>
                                    <option value="Berita">Berita</option>
                                    <option value="Edukasi">Edukasi</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                </select>
                                <div class="invalid-feedback">
                                    Harap Isi Kategori
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea name="banner" id="editorBanner" placeholder="Banner"></textarea>
                            </div>
                            <div class="col-md-12">
                                <textarea name="konten" id="editorArtikel" placeholder="Edukasi"></textarea>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/44.2.0/ckeditor5.umd.js"></script>



    <script>
        let images = [];
        currentPage = 1;
        const perPage = 8;
        let targetEditor = null; // Editor yang sedang dipilih

        document.addEventListener("DOMContentLoaded", function() {
            const {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph,
                Image,
                ImageToolbar,
                ImageUpload,
                SimpleUploadAdapter,
                ImageResize,
                ImageStyle,
                ImageCaption
            } = CKEDITOR;

            const editorConfig = {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzEwMjcxOTksImp0aSI6IjQzOWIwZjEzLTZmNjctNGMzNC1hNDNjLTI5ZGM3OWU4OWJjZCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCJdLCJ2YyI6IjI5ZDQ3YzkwIn0.my480__YZIMVXg3r0TZWe_NmC1qy8fgEJwIRIgL6arVdFUsjWy-2XDfW80aqUpySFoNr_XIHL8IMrys-QVIzTw',
                plugins: [Essentials, Bold, Italic, Font, Paragraph, Image, ImageToolbar, ImageUpload, SimpleUploadAdapter, ImageResize, ImageStyle, ImageCaption],
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|', 'uploadImage', '|', 'imageStyle:full', 'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignRight', '|', 'imageResize', 'toggleImageCaption'],
                simpleUpload: {
                    uploadUrl: '<?= base_url('apps/dema/upload') ?>',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            };

            // Editor Artikel (Lengkap)
            ClassicEditor
                .create(document.querySelector('#editorArtikel'), editorConfig)
                .then(editor => {
                    window.editorArtikel = editor;
                    addGalleryButton(editor, "Pilih Gambar dari Galeri", () => openGalleryModal(editor));
                });

            // Editor Banner (Hanya Gambar)
            ClassicEditor
                .create(document.querySelector('#editorBanner'), {
                    ...editorConfig,
                    toolbar: ['uploadImage', '|', 'imageStyle:full', 'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignRight', '|', 'imageResize']
                })
                .then(editor => {
                    window.editorBanner = editor;
                    addGalleryButton(editor, "Pilih Gambar dari Galeri", () => openGalleryModal(editor));
                });

            document.getElementById("searchBox").addEventListener("input", searchImages);
        });

        function addGalleryButton(editor, text, onClickFunction) {
            const toolbar = editor.ui.view.toolbar;
            const button = document.createElement('button');
            button.innerText = text;
            button.type = "button";
            button.style.marginLeft = "10px";
            button.onclick = onClickFunction;
            toolbar.element.appendChild(button);
        }

        async function openGalleryModal(editor) {
            targetEditor = editor;
            const galleryContainer = document.getElementById("galleryContainer");
            galleryContainer.innerHTML = "Memuat...";

            try {
                const response = await fetch("<?= base_url('apps/dema/gallery') ?>");
                images = await response.json();

                if (!images.length) {
                    galleryContainer.innerHTML = "<p>Galeri kosong!</p>";
                    return;
                }

                currentPage = 1;
                displayImages();
                $('#galleryModal').modal('show');
            } catch (error) {
                galleryContainer.innerHTML = "<p>Gagal memuat gambar.</p>";
            }
        }

        function displayImages() {
            const galleryContainer = document.getElementById("galleryContainer");
            galleryContainer.innerHTML = "";

            let filteredImages = images;
            const searchQuery = document.getElementById("searchBox").value.toLowerCase();
            if (searchQuery) {
                filteredImages = images.filter(img => img.src.toLowerCase().includes(searchQuery));
            }

            const start = (currentPage - 1) * perPage;
            const paginatedImages = filteredImages.slice(start, start + perPage);

            if (paginatedImages.length === 0) {
                galleryContainer.innerHTML = "<p>Gambar tidak ditemukan.</p>";
                return;
            }

            paginatedImages.forEach(img => {
                let imageWrapper = document.createElement("div");
                imageWrapper.style.position = "relative";
                imageWrapper.style.display = "inline-block";
                imageWrapper.style.margin = "5px";

                let imageElement = document.createElement("img");
                imageElement.src = img.src;
                imageElement.style.width = "100px";
                imageElement.style.cursor = "pointer";
                imageElement.onclick = () => insertImageIntoEditor(img.src);

                let deleteButton = document.createElement("button");
                deleteButton.innerText = "X";
                deleteButton.style.position = "absolute";
                deleteButton.style.top = "5px";
                deleteButton.style.right = "5px";
                deleteButton.style.background = "red";
                deleteButton.style.color = "white";
                deleteButton.style.border = "none";
                deleteButton.style.cursor = "pointer";
                deleteButton.onclick = () => deleteImage(img.src);

                imageWrapper.appendChild(imageElement);
                imageWrapper.appendChild(deleteButton);
                galleryContainer.appendChild(imageWrapper);
            });

            updatePagination(filteredImages.length);
        }

        function deleteImage(imageUrl) {
            // Ekstrak nama file dari URL
            const filename = imageUrl.split('/').pop();

            // Ambil CSRF token secara dinamis setiap kali request
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "<?= base_url('apps/dema/delete') ?>",
                type: "POST",
                data: {
                    filename: filename,
                    '<?= csrf_token() ?>': csrfToken // Kirim token secara dinamis
                },
                dataType: "json",
                success: function(response) {
                    alert(response.message);
                    refreshGallery();
                },
                error: function(xhr, status, error) {
                    alert("Gagal menghapus gambar.");
                }
            });
        }

        async function refreshGallery() {
            try {
                const response = await fetch("<?= base_url('apps/dema/gallery') ?>");
                images = await response.json();
                displayImages();
            } catch (error) {}
        }

        function updatePagination(totalImages) {
            document.getElementById("pageInfo").innerText = `Halaman ${currentPage} dari ${Math.ceil(totalImages / perPage)}`;
            document.getElementById("prevPage").disabled = currentPage === 1;
            document.getElementById("nextPage").disabled = currentPage >= Math.ceil(totalImages / perPage);
        }

        function changePage(direction) {
            currentPage += direction;
            displayImages();
        }

        function searchImages() {
            currentPage = 1;
            displayImages();
        }

        function insertImageIntoEditor(imageUrl) {
            if (targetEditor) {
                targetEditor.model.change(writer => {
                    const imageElement = writer.createElement('imageBlock', {
                        src: imageUrl
                    });
                    targetEditor.model.insertContent(imageElement, targetEditor.model.document.selection);
                });
            }
            closeModal();
        }

        function closeModal() {
            $('#galleryModal').modal('hide');
        }
    </script>



    <div id="galleryModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <br>
                </div>
                <div class="modal-body"><input type="text" class="form-control form-control-sm" id="searchBox" class="search-box" placeholder="Cari gambar...">
                    <style>
                        .modal img {
                            width: 100px;
                            height: auto;
                            margin: 5px;
                            cursor: pointer;
                            border-radius: 5px;
                            transition: transform 0.2s;
                        }

                        .modal img:hover {
                            transform: scale(1.1);
                        }
                    </style>
                    <div id="galleryContainer"></div>

                </div>
                <div class="modal-footer">
                    <div style="float: left;">
                        <span id="pageInfo"></span>
                    </div>
                    <button type="button" class="btn  btn-sm btn-primary" id="prevPage" onclick="changePage(-1)">Prev</button>
                    <button type="button" class="btn  btn-sm btn-primary" id="nextPage" onclick="changePage(1)">Next</button>
                </div>

            </div>
        </div>

    </div>