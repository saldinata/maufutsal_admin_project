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
            User Level Pemilik Lapangan
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Username </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Tanggal Terdaftar</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">ID Reg</th>

                </tr>
              </thead>

              <tbody>
                <?php
                  $level = "ownerfield";
                  $query = "SELECT * FROM tbl_user WHERE level=?";
                  $get_member = $db->getAllValue($query,[$level]);

                  foreach($get_member as $data_member)
                  {
                     $date_join = $util->changeFormatDateFromNumberToString(substr($data_member['id_reg'],0,8));

                    echo "<tr>";
                    echo "<td style=\"font-size: 11px;\">".$data_member['name']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$data_member['username']."</td>";
                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">".$date_join."</td>";
                    echo "<td class=\"text-center\" style=\"font-size: 11px;\">".$data_member['id_reg']."</td>";
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
