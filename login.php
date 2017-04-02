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
    <body>
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
                        <div class="wrapper-page">
                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="index-2.html" class="text-success">
                                            <span>
                                              <img src="_assets/images/logo.png" alt="image_logo" height="36"></span>
                                        </a>
                                    </h2>
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="#">
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="text" required="" placeholder="Username" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" type="password" required="" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Masuk</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                        </div>
                        <!-- end wrapper -->

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

    </body>
</html>
