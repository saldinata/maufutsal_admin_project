<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Daftar Lapangan Futsal</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Lapangan Futsal
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Lapangan</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Alamat</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Kota</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Provinsi</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Tanggal Bergabung</th>


                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_field_information";
                  $get_field_info = $db->getAllValue($query);

                  foreach($get_field_info as $data_info)
                  {
                     $date_join = $util->changeFormatDateFromNumberToString(substr($data_info['court_reg'],0,8));

                     $id_prov = $data_info['id_prov'];
                     $id_city = $data_info['id_kota'];

                     $query   = "SELECT * FROM tbl_provinsi WHERE provinsi_id=?";
                     $prov_name  = $db->getValue($query,[$id_prov]);

                     $query   = "SELECT * FROM tbl_city WHERE kota_id=?";
                     $city_name  = $db->getValue($query,[$id_city]);

                     echo "<tr>";
                     echo "<td style=\"font-size: 11px;\">".$data_info['nama_lapangan']."</td>";
                     echo "<td style=\"font-size: 11px;\">".$data_info['alamat']."</td>";
                     echo "<td class=\"text-center\" style=\"font-size: 11px; \">".$city_name['kokab_nama']."</td>";
                     echo "<td class=\"text-center\" style=\"font-size: 11px;\">".$prov_name['provinsi_nama']."</td>";
                     echo "<td class=\"text-center\" style=\"font-size: 11px;\">".$date_join."</td>";
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
