<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Approve Informasi Data Owner</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Approve Informasi Data Owner
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>
          
            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Lapangan </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Alamat</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Provinsi</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Kota</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Opsi</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $state         = '0';
                  $counter       = 0;
                  $query         = "SELECT * FROM tbl_user WHERE state=?";
                  $get_all_new   = $db->getAllValue($query,[$state]);

                  foreach($get_all_new as $data_trx)
                  {
                     $counter++;
                     $court_reg  = $data_trx['id_reg'];
                     $id_user    = $data_trx['id_user'];
                     
                     $query      = "SELECT * FROM tbl_field_information WHERE court_reg=?";
                     $fetch_data = $db->getValue($query,[$court_reg]);
                     $field_name = !empty($fetch_data) ? $fetch_data['nama_lapangan'] : "< not found field name data >";
                     
                     $id_prov    = $fetch_data['id_prov'];
                     $id_kota    = $fetch_data['id_kota'];
                     
                     $query      = "SELECT * FROM tbl_provinsi WHERE provinsi_id=?";
                     $result_data= $db->getValue($query,[$id_prov]);
                     $prov_name  = $result_data['provinsi_nama'];
                     
                     $query      = "SELECT * FROM tbl_city WHERE kota_id=?";
                     $result_data= $db->getValue($query,['id_kota']);
                     $city_name  = $result_data['kokab_nama'];
                             
                     echo "<tr>";
                     echo "<td style=\"font-size: 11px;text-align: center;\">".$field_name."</td>";
                     echo "<td style=\"font-size: 11px;text-align: center;\">".$fetch_data['alamat']."</td>";
                     echo "<td style=\"font-size: 11px;text-align: center;\">".$prov_name."</td>";
                     echo "<td style=\"font-size: 11px;text-align: center;\">".$city_name."</td>";
                     
                     echo "<td style=\"font-size: 11px;text-align: center;\">";

//                     echo "<button class=\"btn btn-icon waves-effect waves-light btn-inverse\" data-toggle=\"modal\" data-target=\"#custom-width-modal\" id=\"reject$counter\"> <i class=\"fa fa-trash-o\"></i> </button>";
//                     echo "&nbsp;&nbsp;&nbsp;";
                     echo "<button class=\"btn btn-icon waves-effect waves-light btn-inverse\" id=\"approve$counter\"> <i class=\"fa fa-check-square-o\"></i> </button>";

                     echo"</td>";

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

   $(document).on("click","button[id^=reject]",rejectRate);
   $(document).on("click","button[id^=approve]",approveRate);


   function rejectRate()
   {
      var numbers = parseInt(this.id.replace("reject",""),10);
      var idharga = $("#idharga"+numbers).val();

      $.ajax
      ({
         type     : "POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqrejectrate"+"&idharga="+idharga,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="resrejectrate")
                  {
                     if(JSONObject[key]["success"]==="true")
                     {
                        alert("Reject berhasil");
                        document.location.reload();
                     }
                  }
               }
            }
         }
      });
      return false;
   }


   function approveRate()
   {
      var numbers = parseInt(this.id.replace("approve",""),10);
      var iduser = $("#iduser"+numbers).val();

      $.ajax
      ({
         type     : "POST",
         url      : "API_admin/apiadmin.php",
         data     : "type=reqchangestate"+"&iduser="+iduser,
         dataType : "JSON",
         cache    : false,
         success  : function(JSONObject)
         {
            for(var key in JSONObject)
            {
               if(JSONObject.hasOwnProperty(key))
               {
                  if(JSONObject[key]["type"]==="reschangestate")
                  {
                     if(JSONObject[key]["success"]==="true")
                     {
                        alert("Approve berhasil");
                        document.location.reload();
                     }
                  }
               }
            }
         }
      });
      return false;
   }
</script>
