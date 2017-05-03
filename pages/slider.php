<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Slider</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title"><b>Upload Slider</b></h4>
          <div class="form-group">
             <label class="control-label">Masukkan file gambar</label>
             <input type="file" id="pict_slider" name="pict_slider" class="filestyle" data-buttonname="btn-default" accept="image/jpeg">

             <div class="form-group">
               <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 0%; margin-bottom: 2%;" id="upload_img_btn"> Simpan Data
               </button>
            </div>

         </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title"><b>Daftar Gambar</b></h4>
            <br/><br/>
            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Path</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Image Preview</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Status</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Option</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_slider";
                  $result_data_img_slider = $db->getAllValue($query);

                  if(!empty($result_data_img_slider))
                  {
                     $counter =0;
                    foreach($result_data_img_slider as $img_data)
                    {
                        $counter++;
                        $id_slider  = $img_data['id_slider'];
                        $path       = "image\slider\\".$img_data['path'];
                        $state      = $img_data['state']=="A" ? "publish" : "not publish";

                        echo "<tr>";
                        echo "<td>".$img_data['path']."</td>";
                        echo "<td style=\"text-align: center\"><img src=\"$path\" width=\"450\" height=\"150\"/></td>";
                        echo "<td style=\"text-align: center\"> ".$state."</td>";
                        echo "<td style=\"text-align: center\">";
                        echo "<button class=\"btn btn-icon waves-effect btn-default\" id=\"p$counter\"><i class=\"fa fa-eye\"></i> </button>";
                        echo "&nbsp;&nbsp;";
                        echo "<button class=\"btn btn-icon waves-effect btn-default\" id=\"np$counter\"><i class=\"fa fa-eye-slash\"></i> </button>";
                        echo "&nbsp;&nbsp;";
                        echo "<button class=\"btn btn-icon waves-effect btn-default\" id=\"del$counter\"><i class=\"fa fa-trash-o\"></i> </button>";
                        echo "</td>";
                        echo "<input type=\"hidden\" value=\"$id_slider\" id=\"idslider$counter\" readonly/>";
                        echo "</tr>";

                    }
                  }
                  else
                  {
                    echo "<tr>";
                    echo "<td colspan=\"4\">Tidak ada data</td>";
                    echo "</tr>";
                  }

                 ?>

              </tbody>
            </thead>
          </table>

        </div>
      </div>
    </div>
    </div>
</div>

<script type="text/javascript">

$(document).on("click","button[id^=p]", publishImg);
$(document).on("click","button[id^=np]", nopublishImg);
$(document).on("click","button[id^=del]", deleteImg);

var initApps = function()
{
   $("#upload_img_btn").click(upload_img);
}

var urls    = "API_admin/uploadslider.php";
var url_act = "API_admin/apiadmin.php";


function publishImg()
{
   var numbering  = parseInt(this.id.replace("p", ""),10);
   var id_sliders = $("#idslider"+numbering).val();

   $.ajax
   ({
         type     :"POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqpubimg"+"&id="+id_sliders,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="respubimg")
                  {
                     if(JSONObject[key]["publish"]==="success")
                     {
                        alert("Gambar berhasil dipublish");
                        document.location.reload();
                     }
                     else
                     {
                        alert("Gambar tidak berhasil dipublish");
                     }
                  }
               }
            }
         }
   });
}


function nopublishImg()
{
   var numbering  = parseInt(this.id.replace("np", ""),10);
   var id_sliders = $("#idslider"+numbering).val();

   $.ajax
   ({
         type     :"POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqnopubimg"+"&id="+id_sliders,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="resnopubimg")
                  {
                     if(JSONObject[key]["nonpublish"]==="success")
                     {
                        alert("Gambar berhasil tidak dipublish");
                        document.location.reload();
                     }
                     else
                     {
                        alert("Gambar gagal tidak dipublish");
                     }
                  }
               }
            }
         }
   });
}



function deleteImg()
{
   var numbering  = parseInt(this.id.replace("del", ""),10);
   var id_sliders = $("#idslider"+numbering).val();

   $.ajax
   ({
         type     :"POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqdelsliderimg"+"&id="+id_sliders,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="resdelsliderimg")
                  {
                     if(JSONObject[key]["deleteimg"]==="success")
                     {
                        alert("Gambar berhasil dihapus");
                        document.location.reload();
                     }
                     else
                     {
                        alert("Gambar tidak berhasil dihapus");
                     }
                  }
               }
            }
         }
   });
}



$(document).ready(initApps);

function upload_img()
{
   var file_data  = $("#pict_slider").prop("files")[0];
   console.log(file_data);

   var form_data  = new FormData();
   form_data.append("file",file_data);
   console.log(form_data);

   $.ajax
   ({
      type        : 'POST',
      url         : urls,
      dataType    : 'text',
      contentType : false,
      processData : false,
      data        : form_data,
      cache       : false,
      success     : function(res)
      {
         document.location.reload();
      }
   });
   return false;
}


</script>
