<?php
  require_once("../libs/act.class.php");
  require_once("../libs/auth.class.php");
  require_once("../libs/database.class.php");
  require_once("../libs/utility.class.php");
  require_once("../libs/class.smtp.php");
  require_once("../libs/phpmailer.php");

  $db   = new Database();
  $util = new Utility();
  $auth = new Authentication($db,$util);
  $act  = new ActivityApps($db,$util,$auth);
  $mail = new PHPMailer();

  if(isset($_POST['type']) && !empty($_POST['type']))
  {
    switch($_POST['type'])
    {
      case 'reqstoredistdat':
      $act->reqstoredistdat($_POST['dist_name'],$_POST['dist_addr'],$_POST['dist_pic'],$_POST['dist_private_phone'],$_POST['dist_office_phone'],$_POST['dist_mail']);
      break;

      case 'reqstoredistpro':
      $act->reqstoredistpro($_POST['dist_name'],$_POST['dist_product'],$_POST['dist_price'],$_POST['dist_note']);
      break;

      default:
      break;
    }
  }


 ?>
