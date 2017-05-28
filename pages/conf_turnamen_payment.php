<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Konfirmasi Pembayaran Turnamen</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Data Konfirmasi Pembayaran Turnamen Futsal
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Date Time</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nominal Transaction </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nomor Booking </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Team </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Status </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Opsional </th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $verification = "1";
                  $query = "SELECT * FROM tbl_member_kompetisi WHERE verification=? ";
                  $get_all_dist = $db->getAllValue($query,[$verification]);

                  $counter = 0;
                  foreach($get_all_dist as $data_trx)
                  {
                     $counter++;
                     $id_booking    = $data_trx['code_reg'];
                     $id_kompetisi  = $data_trx['id_kompetisi'];
                     $name_team     = $data_trx['nama_team'];
                     $id_member_kompetisi = $data_trx['id_member_kompetisi'];

                     $query = "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
                     $data_kompetisi = $db->getValue($query,[$id_kompetisi]);


                    echo "<tr>";
                    echo "<td style=\"font-size:11px; text-align: center;\">".$data_trx['tanggal']."</td>";
                    echo "<td style=\"font-size: 11px; text-align: right;\">"."Rp.".number_format($data_kompetisi['biaya'])."</td>";
                    echo "<td style=\"font-size: 11px;text-align: center;\">".$id_booking."</td>";
                    echo "<td style=\"font-size: 11px;text-align: center;\">".$name_team."</td>";
                    echo "<td style=\"font-size: 16px;text-align: center;\"><span class=\"label label-orange\">menunggu konfirmasi</span></td>";
                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">";

                    echo "<button class=\"btn btn-icon waves-effect waves-light btn-default\" data-toggle=\"modal\" data-target=\"#custom-width-modal\" id=\"prev$counter\"> <i class=\"fa fa-eye\"></i> </button>";
                    echo "&nbsp;&nbsp;&nbsp;";
                    echo "<button class=\"btn btn-icon waves-effect waves-light btn-inverse\" id=\"conf$counter\"> <i class=\"fa fa-check-square-o\"></i> </button>";
                    echo "</td>";

                    echo "<input type=\"hidden\" value=\"$id_member_kompetisi\" id=\"idbooking$counter\" readonly/>";

                    echo "</tr>";
                  }
                 ?>

              </tbody>
            </thead>
          </table>

        </div>
      </div>
    </div>

    </div> <!-- container -->
</div> <!-- content -->


<div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
 <div class="modal-dialog" style="width:55%;">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             <h4 class="modal-title" id="custom-width-modalLabel">Informasi Detail </h4>
         </div>
         <div class="modal-body">
            <div class="col-md-12">
               <span id="modal_booking_number" style="font-weight:700;"></span><br/>
               <span id="modal_nominal_trx" style="font-size: 12px;"></span><br/>
               <span id="modal_date_book" style="font-size: 12px;"></span><br/>
               <span id="modal_booker_name" style="font-size: 12px;"></span><br/>

               <hr/>

               <span id="modal_field_name" style="font-size: 12px;"></span><br/>
               <span id="modal_area_name" style="font-size: 12px;"></span><br/>
               <span id="modal_date_usage" style="font-size: 12px;"></span><br/>
            </div>

         </div>
         <div class="modal-footer" style="border-top: none;">
             <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
             <!-- <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
         </div>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

$(document).on("click","button[id^=conf]",paymentConf);
$(document).on("click","button[id^=prev]",previewPayment)

var initApps = function()
{
   //noting..
}

function previewPayment()
{
   var numbers    = parseInt(this.id.replace("prev",""),10);
   var id_booking = $("#idbooking"+numbers).val();

   console.log(id_booking);

   $.ajax
   ({
      type     : "POST",
      url      : "API_admin/apiadmin.php",
      data     : "type=reqpayturninfo"+"&idbooking="+id_booking,
      dataType : "JSON",
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]["type"]==="respayturninfo")
               {
                  $("#modal_booking_number").html("Nomor Booking  "+JSONObject[key]["code_reg"]);
                  $("#modal_nominal_trx").html("nominal transaksi : "+JSONObject[key]["nominal"]);
                  $("#modal_date_book").html("waktu pendaftaran : "+JSONObject[key]["tanggal_trx"]);
                  $("#modal_booker_name").html("nama team : "+JSONObject[key]["nama_team"]);
                  $("#modal_field_name").html("nama bank : "+JSONObject[key]["bank_name"]);
                  $("#modal_area_name").html("nomor rekening : "+JSONObject[key]["bank_account"]);
                  $("#modal_date_usage").html("pemilik rekening : "+JSONObject[key]["account_name"]);
               }
            }
         }
      }
   });
   return false;
}



function paymentConf()
{
   var numbers    = parseInt(this.id.replace("conf", ""),10);
   var id_booking = $("#idbooking"+numbers).val();

   console.log('nomor_booking'+id_booking);

   $.ajax
   ({
      type     : "POST",
      url      : "API_admin/apiadmin.php",
      data     : "type=reqconfigpayturn"+"&idbooking="+id_booking,
      dataType : "JSON",
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]["type"]==="resconfigpayturn")
               {
                  if(JSONObject[key]["state"]==="success")
                  {
                     console.log("i'm here");
                     alert("Konfirmasi pembayaran telah diapproved");
                     document.location.reload();
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
