<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Approve Perubahan Tarif</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Approve Perubahan Tarif Lapangan Futsal
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Futsal</th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Lapangan </th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Tarif OnSite</th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Tarif Online</th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Berlaku Tarif</th>
                   <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Opsi</th>
                </tr>
              </thead>

              <tbody>
                <?php

                  $state_changed = '1';
                  $query         = "SELECT * FROM tbl_harga_lapangan WHERE status_perubahan=?";
                  $get_all_new   = $db->getAllValue($query,[$state_changed]);

                  foreach($get_all_new as $data_trx)
                  {
                    echo "<tr>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['court_reg']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['name_field']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['pricelist']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['pricelist_online']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_trx['valid_hour']."</td>";
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

    </div>
</div>
