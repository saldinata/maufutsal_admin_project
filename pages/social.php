<?php
   $facebook  = null;
   $twitter   = null;
   $instagram = null;
   $google    = null;

   $query         = "SELECT * FROM tbl_web_social";
   $get_contents  = $db->getAllValue($query);
   if(!empty($get_contents))
   {
      foreach($get_contents as $data_contents)
      {
         $facebook  = $data_contents['facebook'];
         $twitter   = $data_contents['twitter'];
         $instagram = $data_contents['instagram'];
         $google    = $data_contents['google'];
      }
   }
   else
   {
      $facebook  = "";
      $twitter   = "";
      $instagram = "";
      $google    = "";
   }
 ?>

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Social Media Maufutsal</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Data Social Media
          </h4>

          <hr style="border-top: 1px solid #e5e4e4;"/>

          <form role="form">
              <div class="form-group">
                  <label>
                    <i class="mdi mdi-facebook"></i>
                    &nbsp;&nbsp;Facebook
                  </label>

                  <input type="text" class="form-control" placeholder="Insert link address" id="facebook" autocomplete="off" value="<?php echo $facebook; ?>" >
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi  mdi mdi-twitter"></i>
                    &nbsp;&nbsp;Twitter
                  </label>
                  <input type="text" class="form-control" placeholder="Insert link address" id="twitter" autocomplete="off" value="<?php echo $twitter; ?>" >
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi mdi-instagram"></i>
                    &nbsp;&nbsp;&nbsp;Instagram
                  </label>
                  <input type="text" class="form-control" placeholder="Insert link address" id="instagram" autocomplete="off" value="<?php echo $instagram; ?>"  >
              </div>


              <div class="form-group">
                  <label>
                    <i class="mdi mdi mdi-google-plus"></i>
                    &nbsp;&nbsp;&nbsp;Google +
                  </label>
                  <input type="text" class="form-control" placeholder="Insert link address" id="google" autocomplete="off" value="<?php echo $google; ?>"  >

                  <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 0%; margin-bottom: 2%;" id="save_content"> Simpan Data </button>
              </div>

          </form>
        </div>
      </div>
    </div>

    </div>
</div>

<script type="text/javascript">
  var initApps = function()
  {

  };

  var url = "API_admin/apiadmin.php";

  $(document).ready(initApps);
  $("#save_content").click(saveContent);


  function saveContent()
  {
     var facebook    = document.getElementById('facebook').value;
     var twitter     = document.getElementById('twitter').value;
     var instagram   = document.getElementById('instagram').value;
     var google      = document.getElementById('google').value;

    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqsavesocialcontent"+"&facebook="+facebook+"&twitter="+twitter+"&instagram="+instagram+"&google="+google,
        cache     : false,
        success   : function(JSONObject)
        {
          for(var key in JSONObject)
          {
            if(JSONObject.hasOwnProperty(key))
            {
              if((JSONObject[key]["type"])==="ressavesocialcontent")
              {
                if((JSONObject[key]["state"])==="success")
                {
                  alert("Penyimpanan data berhasil");
                }
                else
                {
                  alert("Penyimpanan data tidak berhasil");
                }
              }
            }
          }
        }
    });
    return false;
  }

</script>
