<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Recon Reservasi</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Informasi Reservasi
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="dataRecon" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Date Time</th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nominal Transaction </th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nomor Booking </th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Status </th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_booking_lapangan";
                  $get_all_dist = $db->getAllValue($query);

                  foreach($get_all_dist as $data_trx)
                  {
                     $verification = $data_trx['verification'];

                     echo "<tr>";
                     echo "<td style=\"font-size: 11px;text-align: center;\">".$data_trx['date_time']."</td>";
                     echo "<td style=\"font-size: 11px;text-align: right;\">"."Rp.".number_format($data_trx['price'])."</td>";
                     echo "<td style=\"font-size: 11px;text-align: center;\">".$data_trx['nomor_booking']."</td>";

                     if($verification == "0")
                     {
                        echo "<td style=\"font-size: 13px;text-align: center;\"><span class=\"label label-default\"> Reservasi Baru</span></td>";
                     }
                     else if($verification == "1")
                     {
                        echo "<td style=\"font-size: 13px;text-align: center;\"><span class=\"label label-orange\">Menunggu Konfirmasi</span></td>";
                     }
                     else
                     {
                        echo "<td style=\"font-size: 13px;text-align: center;\"><span class=\"label label-success\">Sudah Dikonfirmasi</span></td>";
                     }

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

   var initApp = function()
   {
      var table = $('#dataRecon').dataTable();
   }

   $(document).ready(initApp);

</script>
