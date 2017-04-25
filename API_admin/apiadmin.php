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

      case 'reqgetalldistpro':
         $act->reqgetalldistpro();
      break;

      case 'reqorderdistpro':
         $act->reqorderdistpro($_POST['futsal_code'],$_POST['nominal'],$_POST['id_product']);
      break;

      case 'reqchklogin':
         $auth->reqchklogin($_POST['user'],$_POST['pass']);
      break;

      case 'reqsaveaboutcontent':
         $act->reqsaveaboutcontent($_POST['contents']);
      break;

      case 'reqsaveprivacycontent':
         $act->reqsaveprivacycontent($_POST['contents']);
      break;

      case 'reqsavecareercontent':
         $act->reqsavecareercontent($_POST['contents']);
      break;

      case 'reqsavecontactcontent':
         $act->reqsavecontactcontent($_POST['phone'],$_POST['address'],$_POST['company'],$_POST['email']);
      break;

      case 'reqsavesocialcontent':
         $act->reqsavesocialcontent($_POST['facebook'],$_POST['twitter'],$_POST['instagram'],$_POST['google']);
      break;

      case 'reqlogout':
         $auth->reqlogout();
      break;

      default:
      break;
    }
  }


 ?>
