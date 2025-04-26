<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>Dashboard eCommerce HTML Template - FreshCart</title>
  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/images/favicon/favicon.ico">


  <!-- Libs CSS -->
  <link href="<?php echo base_url(); ?>/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/theme.min.css">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-M8S4MT3EYG");
  </script>
  <script type="text/javascript">
    (function(c, l, a, r, i, t, y) {
      c[a] =
        c[a] ||
        function() {
          (c[a].q = c[a].q || []).push(arguments);
        };
      t = l.createElement(r);
      t.async = 1;
      t.src = "https://www.clarity.ms/tag/" + i;
      y = l.getElementsByTagName(r)[0];
      y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "kuc8w5o9nt");
  </script>

</head>
<body>
  <!-- main -->
  <div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
          <div class="d-flex align-items-center">
            <a class="text-inherit d-block d-xl-none me-4" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-right" viewBox="0 0 16 16">
                <path
                  d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm10.646 2.146a.5.5 0 0 1 .708.708L11.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zM2 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
              </svg>
            </a>
          </div>
          <div>
            <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
              <li class="dropdown ms-4">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url(); ?>/assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-md rounded-circle" />
                </a>

                <div class="dropdown-menu dropdown-menu-end p-0">
                  <div class="lh-1 px-5 py-4 border-bottom">
                    <h5 class="mb-1 h6">FreshCart Admin</h5>
                    <small>admindemo@email.com</small>
                  </div>
                  <div class="border-top px-5 py-3">
                    <a href="#">Log Out</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="main-wrapper">
      <!-- navbar vertical -->
      <!-- navbar -->
      <nav class="navbar-vertical-nav d-none d-xl-block">
        <?php $this->load->view('template/sidebar'); ?>
      </nav>

      <nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
        <?php $this->load->view('template/sidebar'); ?>
			</nav>