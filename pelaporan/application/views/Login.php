<!doctype html>
<html lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Axoma">
    <meta name="keywords" content="Axoma">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="<?= base_url(); ?>assets_login\static\plugin\bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\font-awesome\css\fontawesome-all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\et-line\style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\themify-icons\themify-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\owl-carousel\css\owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\plugin\magnific\magnific-popup.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\css\style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_login\static\css\color\default.css" rel="stylesheet" id="color_theme">
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
          <div class="row align-items-center justify-content-center p-100px-tb sm-p-60px-b">
            <div class="col-lg-5 md-p-30px-tb">
              <h1 class="font-alt white-color">Login</h1>
              <div class="subscribe-block">
                  <div class="card-block py-lg px-md">
                    <form id="loginForm" class="md-form form-light" role="form" action="<?= base_url(); ?>welcome/login" method="post">
                        
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="inputUser" class="form-label">Username</label>
                            <div class="md-form-line-wrap">
                              <input id="inputUser" type="text" name="username" placeholder="Username" class="form-control" required autocomplete="off" autofocus="">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="inputPassword" class="form-label">Password</label>
                            <div class="md-form-line-wrap">
                              <input id="inputPassword" type="password" name="password" placeholder="Password" class="form-control" required autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            
                          </div>
                        </div></br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-light"><span class="btn-elem-wrap"><span class="text" style="color: darkblue">LOGIN</span></span></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <label>Tidak punya akun? daftar <a style="text-decoration: underline; color: white;" href="<?= base_url(); ?>welcome/register">disini</a></label>
                    </div>
                    <div class="col-md-4">
                      <label><a  style="text-decoration: underline; color: white;" href="<?= base_url(); ?>welcome/forgot_password">Forgot Password?</a></label>
                    </div>
                  </div>
              </div>
            </div> 
            <div class="col-lg-7 text-center p-50px-l">
              <img src="<?= base_url(); ?>assets_login\static\img\home-banner-7.svg" title="" alt="">
            </div>
          </div> 
        </div>
      </section>

    </main>
    
    <script src="<?= base_url(); ?>assets_login\static\js\jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\js\jquery-migrate-3.0.0.min.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\plugin\appear\jquery.appear.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\plugin\bootstrap\js\popper.min.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\plugin\bootstrap\js\bootstrap.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\plugin\particles\particles.min.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\plugin\particles\particles-app.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\js\jquery.parallax-scroll.js"></script>
    <script src="<?= base_url(); ?>assets_login\static\js\custom.js"></script>

  </body>
</html>