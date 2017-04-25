<script src="plugins/ckeditor/ckeditor.js" ></script>

<?php
   $content       = null;
   $query         = "SELECT * FROM tbl_web_privacy";
   $get_contents  = $db->getAllValue($query);
   if(!empty($get_contents))
   {
      foreach($get_contents as $data_contents)
      {
         $content = $data_contents['content'];
      }
   }
   else
   {
      $content = "";
   }
 ?>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Kebijakan Privacy Maufutsal</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Konten Kebijakan Privacy Maufutsal
          </h4>

          <hr style="border-top: 1px solid #e5e4e4;"/>

          <form role="form">
            <div class="form-group">
               <!-- <label>
                 <i class="mdi mdi-account-outline"></i>
                 &nbsp;&nbsp;Judul Kontent
               </label> -->
               <textarea class="form-control" rows="20" id="ckeditor" ><?php echo $content ?></textarea>
               <script>CKEDITOR.replace('ckeditor',{height: 450});</script>
            </div>

            <div class="form-group">
               <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 0%; margin-bottom: 2%;" id="save_content"> Simpan Data
               </button>
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
    var contents  = CKEDITOR.instances['ckeditor'].getData();

    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqsaveprivacycontent"+"&contents="+contents,
        cache     : false,
        success   : function(JSONObject)
        {
          for(var key in JSONObject)
          {
            if(JSONObject.hasOwnProperty(key))
            {
              if((JSONObject[key]["type"])==="ressaveprivacycontent")
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
