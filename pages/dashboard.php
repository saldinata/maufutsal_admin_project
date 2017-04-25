<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row text-center">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card-box widget-box-one" style="background-color:#737273;">
                <div class="wigdet-one-content">
                    <h2 class="text-danger">
                       <?php
                        $level  = "member";
                        $counter= 0;
                        $query  = "SELECT * FROM tbl_user WHERE level=?";
                        $result = $db->getAllValue($query,[$level]);

                        foreach($result as $dataCounter)
                        {
                           $counter++;
                        }
                       ?>
                       <span data-plugin="counterup" style="color:#eaeaea;"><?php echo $counter; ?></span>
                    </h2>
                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">User Member</p>
                       <!-- <p class="text-muted m-0">member</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card-box widget-box-one" style="background-color:#737273;">
                <div class="wigdet-one-content">
                    <h2 class="text-dark">
                       <?php
                        $level  = "ownerfield";
                        $counter= 0;
                        $query  = "SELECT * FROM tbl_user WHERE level=?";
                        $result = $db->getAllValue($query,[$level]);

                        foreach($result as $dataCounter)
                        {
                           $counter++;
                        }
                       ?>
                       <span data-plugin="counterup" style="color:#eaeaea;">
                          <?php echo $counter; ?>
                       </span>
                    </h2>
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">User Owner</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card-box widget-box-one" style="background-color:#737273;">
                <div class="wigdet-one-content">
                    <h2 class="text-success">
                       <?php
                        $level  = "eo";
                        $counter= 0;
                        $query  = "SELECT * FROM tbl_user WHERE level=?";
                        $result = $db->getAllValue($query,[$level]);

                        foreach($result as $dataCounter)
                        {
                           $counter++;
                        }
                       ?>
                       <span data-plugin="counterup" style="color:#eaeaea;">
                          <?php echo $counter; ?>
                       </span>
                    </h2>
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">User EO</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card-box widget-box-one" style="background-color:#737273;">
                <div class="wigdet-one-content">
                    <h2 class="text-warning">
                       <?php
                        $genre  = "3";
                        $counter= 0;
                        $query  = "SELECT * FROM tbl_user WHERE genre=?";
                        $result = $db->getAllValue($query,[$genre]);

                        foreach($result as $dataCounter)
                        {
                           $counter++;
                        }
                       ?>
                       <span data-plugin="counterup" style="color:#eaeaea;">
                          <?php echo $counter; ?>
                       </span>
                    </h2>
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">Pekerja</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card-box widget-box-one" style="background-color:#737273;">
                <div class="wigdet-one-content">
                    <h2 class="text-primary">
                       <?php
                        $genre  = "2";
                        $counter= 0;
                        $query  = "SELECT * FROM tbl_user WHERE genre=?";
                        $result = $db->getAllValue($query,[$genre]);

                        foreach($result as $dataCounter)
                        {
                           $counter++;
                        }
                       ?>
                       <span data-plugin="counterup" style="color:#eaeaea;">
                          <?php echo $counter; ?>
                       </span>
                    </h2>
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">Mahasiswa</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card-box widget-box-one" style="background-color:#737273;">
                <div class="wigdet-one-content">
                    <h2 class="text-danger">
                       <?php
                        $genre  = "1";
                        $counter= 0;
                        $query  = "SELECT * FROM tbl_user WHERE genre=?";
                        $result = $db->getAllValue($query,[$genre]);

                        foreach($result as $dataCounter)
                        {
                           $counter++;
                        }
                       ?>
                       <span data-plugin="counterup" style="color:#eaeaea;">
                          <?php echo $counter; ?>
                      </span>
                    </h2>
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">Siswa/Pelajar</p>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 50k</p> -->
                </div>
            </div>
        </div>
    </div>

   <div class="row text-center">
      <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="card-box widget-box-one" style="background-color:#737273;">
             <div class="wigdet-one-content">
                  <h2 class="text-danger">
                     <?php
                      $counter= 0;
                      $query  = "SELECT * FROM tbl_field_information";
                      $result = $db->getAllValue($query,[$level]);

                      foreach($result as $dataCounter)
                      {
                         $counter++;
                      }
                     ?>
                     <span data-plugin="counterup" style="color:#eaeaea;"><?php echo $counter; ?></span>
                  </h2>
                      <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">Lapangan</p>
                     <!-- <p class="text-muted m-0">member</p> -->
             </div>
          </div>
      </div>

      <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="card-box widget-box-one" style="background-color:#737273;">
             <div class="wigdet-one-content">
                  <h2 class="text-danger">
                     <?php
                      $counter = 0;
                      $util->setDefaultTimeZone("Asia/Bangkok");
                      $today  = $util->setDateRegisterForToday();

                      $query  = "SELECT * FROM tbl_kompetisi";
                      $result = $db->getAllValue($query);

                      foreach($result as $dataCounter)
                      {
                        $expired_date = $dataCounter['register'];

                        if($today<=$expired_date)
                        {
                           $counter++;
                        }
                      }
                     ?>
                     <span data-plugin="counterup" style="color:#eaeaea;"><?php echo $counter; ?></span>
                  </h2>
                  <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">
                     Turnamen
                  </p>
             </div>
          </div>
      </div>

      <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="card-box widget-box-one" style="background-color:#737273;">
             <div class="wigdet-one-content">
                  <h2 class="text-danger">
                     <?php
                      $counter = 0;
                      $query  = "SELECT * FROM tbl_distributor";
                      $result = $db->getAllValue($query);

                      foreach($result as $dataCounter)
                      {
                        $counter++;
                      }
                     ?>
                     <span data-plugin="counterup" style="color:#eaeaea;"><?php echo $counter; ?></span>
                  </h2>
                      <p class="m-0 text-uppercase font-600 font-secondary text-overflow" style="color:#eaeaea;">Distributor</p>
            </div>
          </div>
      </div>
   </div>

   <div class="row">

   </div>

    </div>
</div>
