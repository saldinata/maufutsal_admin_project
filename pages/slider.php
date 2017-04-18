<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Slider</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title"><b>Upload Slider</b></h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <h4 class="m-t-0 header-title"><b>Daftar Gambar</b></h4>
            <br/><br/>
            <table id="datatable" class="table table-striped table-colored table-info">
              <thead>
                <tr>
                    <th>Path</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_slider";
                  $result_data_img_slider = $db->getAllValue($query);

                  if(!empty($result_data_img_slider))
                  {
                    foreach($result_data_img_slider as $img_data)
                    {
                        echo "<tr>";
                        echo "<td>".$img_data['path']."</td>";
                        echo "<td>Path</td>";
                        echo "<td>".$img_datap['show']."</td>";
                        echo "<td>publish | not publish</td>";
                        echo "</tr>";
                    }
                  }
                  else
                  {
                    echo "<tr>";
                    echo "<td colspan=\"4\">Tidak ada data</td>";
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
