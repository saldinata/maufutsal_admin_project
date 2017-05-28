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

  if($datCookies=="false")
  {
      echo "<script>document.location.href=\"login\"; </script>";
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

<body class="fixed-left">
    <!-- <div id="preloader">
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
    </div> -->

    <div id="wrapper">
            <div class="topbar">
                <div class="topbar-left" style="background: #7a9fa2;">
                    <a href="index-2.html" class="logo"><span style="font-size:18px;">Internal <span style="font-size:18px;">Platform</span></span><i class="mdi mdi-cube"></i></a>
                </div>

                <div class="navbar navbar-default" role="navigation" style="background-color: #95b3b5;">
                    <div class="container">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown user-box">
                                <a href="#" class="dropdown-toggle waves-effect waves-light user-link" data-toggle="dropdown" aria-expanded="true">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <!-- <li>
                                        <h5>Hi, John</h5>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li> -->
                                    <li><a href="javascript:void(0)" id="logout"><i class="ti-power-off m-r-5" ></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <?php
                      require_once('components/sidebar.php');
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="content-page">
              <?php
                  if(isset($_GET['mov']))
                  {
                    include('pages/'.$_GET['mov'].'.php');
                  }
                  else
                  {
                    include('pages/dashboard.php');
                  }
              ?>

              <?php
                 require_once('components/footer.php');
              ?>
            </div>
        </div>

      <script>
          var resizefunc = [];
      </script>

      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/detect.js"></script>
      <script src="assets/js/fastclick.js"></script>
      <script src="assets/js/jquery.blockUI.js"></script>
      <script src="assets/js/waves.js"></script>
      <script src="assets/js/jquery.slimscroll.js"></script>
      <script src="assets/js/jquery.scrollTo.min.js"></script>
      <script src="plugins/switchery/switchery.min.js"></script>

      <script src="plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
      <script type="text/javascript" src="plugins/multiselect/js/jquery.multi-select.js"></script>
      <script type="text/javascript" src="plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
      <!-- <script src="plugins/select2/js/select2.min.js" type="text/javascript"></script> -->
      <script src="plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
      <script src="plugins/waypoints/jquery.waypoints.min.js"></script>
      <script src="plugins/counterup/jquery.counterup.min.js"></script>
  		<!-- <script src="plugins/morris/morris.min.js"></script> -->
  		<script src="plugins/raphael/raphael-min.js"></script>
      <script src="assets/pages/jquery.dashboard.js"></script>
      <script src="plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
      <script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
      <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
      <script type="text/javascript" src="plugins/autocomplete/jquery.mockjax.js"></script>
      <script type="text/javascript" src="plugins/autocomplete/countries.js"></script>
      <!-- <script type="text/javascript" src="plugins/autocomplete/jquery.autocomplete.min.js"></script> -->
      <!-- <script type="text/javascript" src="assets/pages/jquery.autocomplete.init.js"></script> -->
      <!--
      <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>-->

      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>

      <script src="plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="plugins/datatables/dataTables.bootstrap.js"></script>
      <script src="plugins/datatables/dataTables.buttons.min.js"></script>
      <script src="plugins/datatables/buttons.bootstrap.min.js"></script>
      <script src="plugins/datatables/jszip.min.js"></script>
      <script src="plugins/datatables/pdfmake.min.js"></script>
      <script src="plugins/datatables/vfs_fonts.js"></script>
      <script src="plugins/datatables/buttons.html5.min.js"></script>
      <script src="plugins/datatables/buttons.print.min.js"></script>
      <script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>
      <script src="plugins/datatables/dataTables.keyTable.min.js"></script>
      <script src="plugins/datatables/dataTables.responsive.min.js"></script>
      <script src="plugins/datatables/responsive.bootstrap.min.js"></script>
      <script src="plugins/datatables/dataTables.scroller.min.js"></script>
      <script src="plugins/datatables/dataTables.colVis.js"></script>
      <script src="plugins/datatables/dataTables.fixedColumns.min.js"></script>
      <script src="assets/pages/jquery.datatables.init.js"></script>

      <script type="text/javascript">
          $(document).ready(function ()
          {
              $('#datatable').dataTable();
              $('#datatable-keytable').DataTable({keys: true});
              $('#datatable-responsive').DataTable();
              $('#datatable-colvid').DataTable({
                  "dom": 'C<"clear">lfrtip',
                  "colVis": {
                      "buttonText": "Change columns"
                  }
              });
              $('#datatable-scroller').DataTable({
                  ajax: "plugins/datatables/json/scroller-demo.json",
                  deferRender: true,
                  scrollY: 380,
                  scrollCollapse: true,
                  scroller: true
              });
              var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
              var table = $('#datatable-fixed-col').DataTable({
                  scrollY: "300px",
                  scrollX: true,
                  scrollCollapse: true,
                  paging: false,
                  fixedColumns: {
                      leftColumns: 1,
                      rightColumns: 1
                  }
              });
          });
          TableManageButtons.init();
      </script>
      </body>
</html>

<script type="text/javascript">
var initApps = function()
{
   $("#logout").click(logout);
}

var url = "API_admin/apiadmin.php";

$(document).ready(initApps);

function logout()
{
   $.ajax
   ({
      type     : "POST",
      url      : url,
      dataType : "JSON",
      data     : "type=reqlogout",
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]["type"]==="reslogout")
               {
                  var destination = JSONObject[key]["destination"];
                  document.location.href=destination;
               }
            }
         }
      }
   });
   return false;
}
</script>
