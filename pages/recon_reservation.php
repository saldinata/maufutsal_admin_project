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

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Date Time</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nominal Transaction </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nomor Booking </th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_booking_lapangan";
                  $get_all_dist = $db->getAllValue($query);

                  foreach($get_all_dist as $data_trx)
                  {
                    echo "<tr>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['date_time']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['price']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['nomor_booking']."</td>";
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
