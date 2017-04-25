<?php
  require_once("libs/act.class.php");
  require_once("libs/auth.class.php");
  require_once("libs/database.class.php");
  require_once("libs/utility.class.php");
  require_once("libs/class.smtp.php");
  require_once("libs/phpmailer.php");
  require_once("libs/header.class.php");

  $db   = new Database();
  $util = new Utility();
  $auth = new Authentication($db,$util);
  $act  = new ActivityApps($db,$util,$auth);
  $mail = new PHPMailer();
  $head = new Header();

  $chkCookies  = json_decode($auth->reqchklogincookie());
  $datCookies  = $chkCookies->{'returnBack'};

  if($datCookies=="true")
  {
      echo "<script>document.location.href=\"main\"; </script>";
  }
 ?>

<!DOCTYPE html>
<html>
<head>
  <?php
    echo $head->getMetaInformation();
    echo $head->getTitle();
    echo $head->getLink();
    echo $head->getScript();
    echo $head->getDatabaseCSS();
    echo $head->getJquery();
  ?>
</head>
    <body style="background-color: rgba(10, 103, 5, 0.901961);">
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                  <div class="spinner-wrapper">
                    <div class="rotator">
                      <div class="inner-spin"></div>
                      <div class="inner-spin"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- HOME -->
        <section>

            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">
                       <div>
                          <img src="image/logo_maufutsal_warna.svg" alt="image_logo" height="10" class="img-responsive center-block" style="max-width: 600px; height: 200px;">
                      </div>

                        <div class="wrapper-page">
                            <div class="m-t-40 account-pages" style="    box-shadow: none;">
                                <div class="text-center account-logo-box" style="background-color: rgba(38, 160, 38, 0.93);">
                                 <span style="text-transform: none; color :#ffffff;
                                 ">
                                    Authentication Login
                                 </span>

                                </div>
                                <div class="account-content" style="background-color: rgba(32, 33, 31, 0.17);">
                                    <!-- <form class="form-horizontal"> -->
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" required="" placeholder="Username" autocomplete="off" style="color: #ffffff; border-bottom: 1px solid rgba(210, 210, 210, 0.25);" id="username">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" required="" placeholder="Password" autocomplete="off" style="color: #ffffff;border-bottom: 1px solid rgba(210, 210, 210, 0.25);" id="password">
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"  style="    border-bottom: 2px solid #3ac131 !important;background-color: #3ac131 !important;
                                                border: 1px solid #3ac131 !important;margin-top: 15%;" id="btn_enter">Masuk</button>
                                            </div>
                                        </div>

                                    <!-- </form> -->

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script src="assets/js/login.js"></script>

    </body>
</html>
