<?php

class Header
{
  private $data;

  public function getMetaInformation()
  {
    $data = "<meta charset=\"utf-8\">";
    $data .="<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    $data .="<meta name=\"description\" content=\"-\">";
    $data .="<meta name=\"saldinata bobby ardani\" content=\"maufutsal admin platform\">";

    return $data;
  }

  public function getTitle()
  {
    $data = "<title>Maufutsal Internal Platform</title>";

    return $data;
  }

  public function getLink()
  {
    $data = "<link rel=\"shortcut icon\" href=\"assets/images/favicon.ico\">";
  	$data .="<link rel=\"stylesheet\" href=\"plugins/morris/morris.css\">";
    $data .="<link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"assets/css/core.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"assets/css/components.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"assets/css/icons.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"assets/css/pages.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"assets/css/menu.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"assets/css/responsive.css\" rel=\"stylesheet\" type=\"text/css\" />";
  	$data .="<link rel=\"stylesheet\" href=\"plugins/switchery/switchery.min.css\">";

    return $data;
  }

  public function getScript()
  {
    $data = "<script src=\"assets/js/modernizr.min.js\"></script>";

    return $data;
  }

  public function getDatabaseCSS()
  {
    $data = "<link href=\"plugins/datatables/jquery.dataTables.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .= "<link href=\"plugins/datatables/buttons.bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .= "<link href=\"plugins/datatables/fixedHeader.bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .="<link href=\"plugins/datatables/responsive.bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .="<link href=\"plugins/datatables/scroller.bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .="<link href=\"plugins/datatables/dataTables.colVis.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .= "<link href=\"plugins/datatables/dataTables.bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";
    $data .="<link href=\"plugins/datatables/fixedColumns.dataTables.min.css\" rel=\"stylesheet\" type=\"text/css\"/>";

    $data .="<link href=\"plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css\" ;rel=\"stylesheet/\" />";
    $data .="<link href=\"plugins/multiselect/css/multi-select.css\"  rel=\"stylesheet\" type=\"text/css\" />";
    $data .= "<link href=\"plugins/select2/css/select2.min.css\" rel=\"stylesheet\" type=\"text/css\" />";
    $data .="<link href=\"plugins/bootstrap-select/css/bootstrap-select.min.css\" rel=\"stylesheet\" />";
    $data .="<link href=\"plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css\" rel=\"stylesheet\" />";


    return $data;
  }

  public function getJquery()
  {
    $data = "<script src=\"assets/js/jquery.min.js\"></script>";
    return $data;
  }
}


 ?>
