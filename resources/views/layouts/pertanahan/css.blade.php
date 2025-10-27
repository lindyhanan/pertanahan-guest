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

  <!-- end css -->
