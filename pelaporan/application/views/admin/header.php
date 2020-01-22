<!doctype html>
<html lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Axoma">
    <meta name="keywords" content="Axoma">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="<?= base_url(); ?>assets_login\static\plugin\bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\font-awesome\css\fontawesome-all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\et-line\style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\themify-icons\themify-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\owl-carousel\css\owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\magnific\magnific-popup.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\css\style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\css\color\default.css" rel="stylesheet" id="color_theme">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  </head>

  <body data-spy="scroll" data-target="#navbar" data-offset="98">


    <div id="loading">
      <div class="load-circle"><span class="one"></span></div>
    </div>
    <main>
      <section id="home" class="home-banner-03 theme-bg bg-effect-box">
        <div class="bg-effect bg-cover" style="background-image: url(static/img/banner-effect-6.svg);"></div>
        <div id="particles_effect" class="particles-effect"></div>
        <div class="container">
          <div class="row" style="margin-top: 60px;">
            <div class="col-md-4">
            <div class="card mb-3 " style="max-width: 540px; border-radius: 20px 20px 0 0;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?= base_url(); ?>assets_login\static\img\logo.jpg" class="card-img" alt="" style="width: 100%; height: 100%; border-radius: 20px 0 0 0;">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">APP</h5>
                    <p class="card-text">Aplikasi Pelaporan Kerusakan</p>
                  </div>
                </div>
              </div>
            </div>
              <div class="card" style=" border-radius: 0 0 5px 5px; margin-top: -20px; border-radius: 0 0 20px 20px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6" style="line-height: 35px;">
                      <b><?= $this->session->userdata('nama'); ?></b>
                    </div>
                    <div class="col-md-6">
                      <a href="<?= base_url(); ?>admin/see_profile" class="btn btn-sm btn-primary">See Profile</a>
                    </div>
                  </div>
                </div>
              </div>

              <style type="text/css">
                ul {
                  list-style: none;
                  width: 100%;
                  margin-left: -20px;
                }
                ul li {
                  margin-bottom: 3px;
                }
                ul li a {
                  width: 100%;
                  left: 0;
                  padding: 10px 20px 10px 20px;
                  display: block;
                  border-radius: 5px;
                }
                ul li a:hover {
                  border: 1px solid #007bff;
                }
                .active {
                  background: #007bff;
                  color: white;
                  font-weight: bold;
                }
                .active:hover {
                  background: #007bff;
                  color: white;
                  font-weight: bold;
                }
              </style>
              <div class="card" style="margin-top: 15px; border-radius: 5px; border-radius: 20px 20px 20px 20px; margin-bottom: 80px;">
                <div class="card-header">
                  <b>Menu</b>
                </div>
                <div class="card-body" style="margin: 0; padding: 0;">
                  <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                      <ul>
                        <li><a href="<?= base_url(); ?>admin/index" <?php if ($this->uri->segment(2) == 'index' or $this->uri->segment(2) == '' or $this->uri->segment(2) == 'see_profile') {echo "class=active";} ?>>Dashboard</a></li>
                        <li><a href="<?= base_url(); ?>admin/kategori" <?php if ($this->uri->segment(2) == 'kategori') {echo "class=active";} ?>>Kategori Laporan</a></li>
                        <li><a href="<?= base_url(); ?>admin/grafik" <?php if ($this->uri->segment(2) == 'grafik') {echo "class=active";} ?>>Grafik</a></li>
                        <li><a href="<?= base_url(); ?>admin/laporan" <?php if ($this->uri->segment(2) == 'laporan') {echo "class=active";} ?>>Laporan</a></li>
                        <li><a href="<?= base_url(); ?>admin/listuser" <?php if ($this->uri->segment(2) == 'listuser') {echo "class=active";} ?>>User</a></li>
                        <li><a href="<?= base_url(); ?>admin/logout" onclick="return confirm('Keluar dari aplikasi?')">Logout</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">