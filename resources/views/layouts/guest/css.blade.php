<!-- start css -->
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PERTANAHAN</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js')}}/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/css')}}/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css')}}/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css')}}/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css')}}/kaiadmin.min.css" />


  </head>
<style>

    #whatsapp-button {
        position: fixed;
        bottom: 20px;          /* Jarak dari bawah */
        right: 20px;           /* Jarak dari kanan */
        z-index: 9999;         /* Supaya di atas elemen lain */
    }

    #whatsapp-button a img {
        width: 55px;           /* Ukuran tombol */
        height: 55px;
        border-radius: 50%;    /* Jadi bulat */
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #whatsapp-button a img:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    }
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
    .navbar-nav .nav-link {
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link:hover {
        color: #d4edda !important;
        transform: translateY(-1px);
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #e9f5e9;
        color: #2e8b57;
    }

    .dropdown-header {
        padding: 0.75rem 1rem;
    }

.hover-card:hover {
    transform: translateY(-5px);
    transition: all 0.2s ease-in-out;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

  html, body {
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    background-color: #f5f7fb;
  }

  /* Hilangkan jarak dari sisa layout sidebar Kaiadmin */
  .main-panel, .wrapper, .content, .page-inner {
    margin-left: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
  }

  /* Pastikan isi konten tidak ketimpa header baru */
  main, .page-inner {
    padding-top: 80px; /* biar konten turun sedikit dari header */
    min-height: 100vh;
  }

  /* Opsional: supaya navbar tetap fixed di atas */
  header.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1030;
  }
</style>


</style>
  <!-- end css -->
<style>
/* OVERLAY */
.detail-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    overflow-y: auto;       /* 🔑 allow scroll */
    padding: 24px 12px;     /* biar aman di mobile */
}

.detail-overlay:target {
    display: flex;
}

.card-header {
    border-radius: 0 !important;
}
/* CARD UTAMA */
.peta-card {
    border-radius: 14px;
    overflow: hidden;
}

/* GAMBAR */
.card-image-wrapper {
    height: 150px;              /* JANGAN LEBIH */
    background: #e9ecef;
    overflow: hidden;
}

.card-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* HEADER HIJAU */
.peta-card .card-header {
    border-radius: 0 !important;
    margin: 0;
}

/* BODY */
.peta-card .card-body {
    padding: 16px;
}

/* FOOTER */
.peta-card .card-footer {
    padding: 14px;
}

/* BOX */
.detail-box {
    background: #fff;
    width: 700px;
    max-width: 95vw;
    max-height: 90vh;
    border-radius: 16px;
    overflow: hidden; /* 🔑 PALING PENTING */
    display: flex;
    flex-direction: column;
}


/* HEADER */
.detail-header {
    background: #2e7d32;
    color: white;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    /* radius atas */
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
}
.card-image-wrapper img {
    transition: transform .4s ease;
}
 .card.dokumen-card {
        border-top: none !important;
    }

.card:hover .card-image-wrapper img {
    transform: scale(1.05);
}
.peta-preview {
    height: 120px;
    border-radius: 12px;
    background: repeating-linear-gradient(
        45deg,
        #e8f5e9,
        #e8f5e9 10px,
        #c8e6c9 10px,
        #c8e6c9 20px
    );
    display: flex;
    align-items: center;
    justify-content: center;
}

.peta-box {
    background: white;
    padding: 8px 14px;
    border-radius: 8px;
    font-weight: bold;
    color: #2e7d32;
    display: flex;
    align-items: center;
    gap: 6px;
}

.peta-preview-empty {
    height: 120px;
    border-radius: 12px;
    background: #f5f7f5;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    color: #9e9e9e;
}

/* BODY */
.detail-body {
    padding: 16px;
    overflow-y: auto;
    background: #fff;

    /* radius bawah */
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* ===== MODE 1 FILE (BESAR) ===== */
.detail-image-single,
.detail-image-wrap {
    border-radius: 16px;
    overflow: hidden;   /* 🔑 PALING PENTING */
}


.detail-image-large,
.detail-image-grid-img {
    border-radius: 0;   /* 🔥 biar nurut parent */
    width: 100%;
    height: 100%;
    object-fit: cover;
}


/* ===== MODE GRID (BANYAK FILE) ===== */
.detail-image-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 16px;
}

.detail-image-grid-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 10px;
}

/* Mobile */
@media (max-width: 576px) {
    .detail-image-grid {
        grid-template-columns: 1fr;
    }
}

.image-action-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    opacity: 0;
    transition: opacity .2s ease;
    z-index: 2;
}

body:has(.detail-overlay:target) {
    overflow: hidden;
}


.detail-body p {
    margin-bottom: 8px;
}

/* IMAGE */
.detail-image {
    width: 100%;
    max-height: 160px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 12px;
}

/* CLOSE */
.close-btn {
    color: white;
    font-size: 20px;
    text-decoration: none;
}
/* ===============================
   HOVER DELETE GAMBAR
   =============================== */

/* Wrapper gambar */
.detail-image-wrap {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

/* Overlay tombol hapus */
.image-delete-form {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(0,0,0,0.45);
    opacity: 0;
    transition: opacity .2s ease;
}

/* Hover desktop */
.detail-image-wrap:hover .image-delete-form {
    opacity: 1;
}

/* Mobile (tidak ada hover) */
@media (hover: none) {
    .image-delete-form {
        opacity: 1;
        align-items: flex-end;
        justify-content: center;
        padding: 8px;
        background: linear-gradient(
            to top,
            rgba(0,0,0,.6),
            rgba(0,0,0,0)
        );
    }

}

/* ===============================
   CARD IMAGE (ATAS CARD PERSIL)
   =============================== */

.card-image-wrapper {
    position: relative;
    height: 160px; /* jangan terlalu tinggi */
    overflow: hidden;
    background: #e9ecef;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}


/* GAMBAR COVER */
.card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* BADGE +4 */
.card-image-badge {
    position: absolute;
    right: 8px;
    bottom: 8px;

    background: rgba(0,0,0,0.7);
    color: #fff;
    font-size: 13px;
    font-weight: 600;

    padding: 4px 10px;
    border-radius: 999px;
}

/* PLACEHOLDER JIKA BELUM ADA FILE */
.card-image-placeholder {
    width: 100%;
    height: 100%;

    background: #e9ecef;
    color: #6c757d;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;

    font-size: 13px;
}

.card-image-placeholder i[data-feather="file-text"] {
    color: #dc3545; /* merah PDF */
}

/* ===== PDF COVER BLUR ===== */
.pdf-cover {
    background: linear-gradient(
        135deg,
        #dee2e6,
        #ced4da
    );
    position: relative;
}

.pdf-cover::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url('/images/pdf-bg.png'); /* optional */
    background-size: cover;
    filter: blur(8px);
    opacity: 0.4;
}

.pdf-cover > * {
    position: relative;
    z-index: 1;
}

.pdf-cover i {
    width: 32px;
    height: 32px;
    color: #dc3545;
}
.detail-image-wrap:hover .image-action-overlay {
    opacity: 1;
}

/* Mobile */
@media (hover: none) {
    .image-action-overlay {
        opacity: 1;
        align-items: flex-end;
        padding: 8px;
        background: linear-gradient(
            to top,
            rgba(0,0,0,.6),
            rgba(0,0,0,0)
        );
    }
}
/* PREVIEW OVERLAY */
.preview-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.8);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.preview-overlay:target {
    display: flex;
}

.preview-box {
    background: #fff;
    max-width: 90vw;
    max-height: 90vh;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.preview-header {
    background: #2e7d32;
    color: white;
    padding: 10px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.preview-body {
    padding: 12px;
    overflow: auto;
}

.preview-image {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    display: block;
    margin: auto;
}

.profile-photo-wrapper {
    position: relative;
    width: 140px;
}

.profile-photo-box {
    width: 140px;
    height: 140px;
    border-radius: 16px;
    overflow: hidden;
    border: 3px solid #81c784;
    background: #eee;
}

.profile-photo-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* 🔑 ini kunci jadi kotak */
}

.profile-photo-delete {
    position: absolute;
    bottom: -10px;
    right: -10px;
}

<style>
/* FLOATING BUTTON */
.dev-float-btn {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 999;
}
.dev-float-btn a {
    width: 52px;
    height: 52px;
    background: #2e7d32;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0,0,0,.25);
}

/* OVERLAY */
.dev-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.dev-overlay:target {
    display: flex;
}

/* BOX */
.dev-box {
    background: white;
    width: 320px;
    border-radius: 16px;
    overflow: hidden;
}
.dev-header {
    background: #2e7d32;
    color: white;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
}
.dev-close {
    color: white;
    text-decoration: none;
}
.dev-body {
    padding: 20px;
}
.dev-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
}

/* FLOATING BUTTON */
.dev-float-btn{
    position: fixed;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    width: 56px;
    height: 56px;
    background: #2e7d32;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    box-shadow: 0 8px 20px rgba(0,0,0,.25);
    font-size: 22px;
    text-decoration: none;
}

/* OVERLAY */
.dev-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.55);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.dev-overlay:target{
    display: flex;
}

/* BOX */
.dev-box{
    width: 360px;
    max-width: 95%;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
}

/* HEADER */
.dev-header{
    background: #2e7d32;
    color: #fff;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.dev-close{
    color: #fff;
    font-size: 18px;
    text-decoration: none;
}

/* BODY */
.dev-body{
    padding: 20px;
}
.dev-photo{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #c8e6c9;
}

/* SOSMED */
.dev-social{
    display: flex;
    justify-content: center;
    gap: 16px;
    font-size: 22px;
}
.dev-social a{
    color: #2e7d32;
}


/* ANIMATION */
@keyframes zoom {
    from { transform: scale(.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>
