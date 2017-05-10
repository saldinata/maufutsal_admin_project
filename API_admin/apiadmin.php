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

      case 'reqpubimg':
         $act->reqpubimg($_POST['id']);
      break;

      case 'reqnopubimg':
         $act->reqnopubimg($_POST['id']);
      break;

      case 'reqdelsliderimg':
         $act->reqdelsliderimg($_POST['id']);
      break;

      case 'reqdelmemacc':
         $act->reqdelmemacc($_POST['id']);
      break;

      case 'reqdelownacc':
         $act->reqdelownacc($_POST['id']);
      break;

      case 'reqresetowneracc':
         $act->reqresetowneracc($_POST['id']);
      break;

      case 'reqadduser':
         $auth->reqadduser($_POST['username'],$_POST['password'],$_POST['level_user']);
      break;

      case 'reqconfieresev':
         $act->reqconfieresev($_POST['idbooking']);
      break;

      case 'reqpayresfiedet':
         $act->reqpayresfiedet($_POST['idbooking']);
      break;

      case 'reqlogout':
         $auth->reqlogout();
      break;

      default:
      break;
    }
  }


 ?>
