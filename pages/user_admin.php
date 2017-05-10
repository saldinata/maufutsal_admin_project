<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Daftar User</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            User Level Administrator
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Username </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Tanggal Terdaftar</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">ID Reg</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Opsional</th>

                </tr>
              </thead>

              <tbody>
                <?php
                  $level = "admin";
                  $query = "SELECT * FROM tbl_user WHERE level=?";
                  $get_member = $db->getAllValue($query,[$level]);

                  $counter = 0;
                  foreach($get_member as $data_member)
                  {
                     $id_user = $data_member['id_user'];
                     $counter++;
                     $date_join = $util->changeFormatDateFromNumberToString(substr($data_member['id_reg'],0,8));

                    echo "<tr>";
                    echo "<td style=\"font-size: 11px;\">".$data_member['name']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_member['username']."</td>";
                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">".$date_join."</td>";
                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">".$data_member['id_reg']."</td>";

                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">";
                    echo "<button class=\"btn btn-icon waves-effect btn-default\" id=\"reset$counter\"><i class=\"fa fa-send-o (alias)\"></i> </button>";
                    echo "&nbsp;&nbsp;";
                    echo "<button class=\"btn btn-icon waves-effect btn-default\" id=\"del$counter\" style=\"background-color:#747575;\"><i class=\"fa fa-trash-o\" style=\"background-color:#747575;color:#f5f5f5;\"></i> </button>";
                    echo "</td>";

                    echo "<input type=\"hidden\" value=\"$id_user\" id=\"iduser$counter\" readonly/>";

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

$(document).on("click","button[id^=reset]",resetAcc);
$(document).on("click","button[id^=del]",delAcc);

var initApps=function()
{
}

function resetAcc()
{
   var numbering  = parseInt(this.id.replace("reset", ""),10);
   var id_user    = $("#iduser"+numbering).val();

   $.ajax
   ({
         type     :"POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqresetmemacc"+"&id="+id_user,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="resresetmemacc")
                  {
                     if(JSONObject[key]["resetacc"]==="success")
                     {
                        alert("Reset Password Akun Berhasil");
                     }
                     else
                     {
                        alert("Reset Password Akun Gagal");
                     }
                  }
               }
            }
         }
   });
   return false;
}


function delAcc()
{
   var numbering  = parseInt(this.id.replace("del", ""),10);
   var id_user = $("#iduser"+numbering).val();

   $.ajax
   ({
         type     :"POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqdelmemacc"+"&id="+id_user,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="resdelmemacc")
                  {
                     if(JSONObject[key]["deleteacc"]==="success")
                     {
                        alert("Akun Admin berhasil dihapus");
                        document.location.reload();
                     }
                     else
                     {
                        alert("Akun member tidak berhasil dihapus");
                     }
                  }
               }
            }
         }
   });
   return false;
}

$(document).ready(initApps);

</script>
