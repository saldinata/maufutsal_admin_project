<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Konfirmasi Reservasi Lapangan</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Data Konfirmasi Reservasi Lapangan Futsal
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Date Time</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nominal Transaction </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nomor Booking </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Status </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Opsional </th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $verification = "1";
                  $query = "SELECT * FROM tbl_booking_lapangan WHERE verification=? ";
                  $get_all_dist = $db->getAllValue($query,[$verification]);

                  $counter = 0;
                  foreach($get_all_dist as $data_trx)
                  {
                     $counter++;
                     $id_booking = $data_trx['id_booking'];

                    echo "<tr>";
                    echo "<td style=\"font-size:11px; text-align: center;\">".$data_trx['date_time']."</td>";

                    echo "<td style=\"font-size: 11px; text-align: right;\">"."Rp.".number_format($data_trx['price'])."</td>";

                    echo "<td style=\"font-size: 11px;text-align: center;\">".$data_trx['nomor_booking']."</td>";

                    echo "<td style=\"font-size: 16px;text-align: center;\"><span class=\"label label-orange\">menunggu konfirmasi</span></td>";

                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">";

                    echo "<button class=\"btn btn-icon waves-effect waves-light btn-default\" data-toggle=\"modal\" data-target=\"#custom-width-modal\" id=\"prev$counter\"> <i class=\"fa fa-eye\"></i> </button>";

                    echo "&nbsp;&nbsp;&nbsp;";

                    echo "<button class=\"btn btn-icon waves-effect waves-light btn-inverse\" id=\"conf$counter\"> <i class=\"fa fa-check-square-o\"></i> </button>";

                    echo "</td>";

                    echo "<input type=\"hidden\" value=\"$id_booking\" id=\"idbooking$counter\" readonly/>";

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
      data     : "type=reqpayresfiedet"+"&idbooking="+id_booking,
      dataType : "JSON",
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]["type"]==="respayresfiedet")
               {
                  $("#modal_booking_number").html("Nomor Booking  "+JSONObject[key]["booking_num"]);
                  $("#modal_nominal_trx").html("nominal transaksi : "+JSONObject[key]["nominal_trx"]);
                  $("#modal_date_book").html("waktu pemakaian : "+JSONObject[key]["date_time"]);
                  $("#modal_booker_name").html("nama pemesan : "+JSONObject[key]["bookers_name"]);
                  $("#modal_field_name").html("nama lapangan futsal : "+JSONObject[key]["field_name"]);
                  $("#modal_area_name").html("nama arena futsal : "+JSONObject[key]["arena_name"]);
                  $("#modal_date_usage").html("waktu penggunaan futsal : "+JSONObject[key]["usage"]);
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

   $.ajax
   ({
      type     : "POST",
      url      : "API_admin/apiadmin.php",
      data     : "type=reqconfieresev"+"&idbooking="+id_booking,
      dataType : "JSON",
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]["type"]==="resconfieresev")
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
