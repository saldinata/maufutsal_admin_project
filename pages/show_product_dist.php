<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Data Product Distributor</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Informasi Product Distributor
          </h4>

            <hr style="border-top: 1px solid #e5e4e4;"/>

            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Distributor</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Code </th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Nama Product</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Harga</th>
                    <th style="background-color: #656664;font-size: 13px;text-align: center;font-size: 11px;">Catatan Tambahan</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_distributor";
                  $get_all_dist = $db->getAllValue($query);

                  foreach($get_all_dist as $data_dist)
                  {
                    $dist_name = $data_dist['nama_dist'];
                    $dist_code = $data_dist['code_dist'];
                    $id_dist   = $data_dist['id_dist'];

                    $query = "SELECT * FROM tbl_product_dist WHERE id_dist=?";
                    $result_dist_detail = $db->getValue($query,[$id_dist]);

                    echo "<tr>";
                    echo "<td style=\"font-size: 11px;\">".$dist_name."</td>";
                    echo "<td style=\"font-size: 11px;\">".$dist_code."</td>";
                    echo "<td style=\"font-size: 11px;\">".$result_dist_detail['nama_product']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$result_dist_detail['price']."</td>";
                    echo "<td style=\"font-size: 11px;\">".$result_dist_detail['note']."</td>";
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
