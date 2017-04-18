<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Entry Distributor</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Entry Data Distributor
          </h4>

          <hr style="border-top: 1px solid #e5e4e4;"/>

          <form role="form">
            <div class="col-sm-1">
            </div>

            <div class="col-sm-5">
              <div class="form-group">
                  <label>
                    <i class="mdi mdi-account-outline"></i>
                    &nbsp;&nbsp;Nama Distributor
                  </label>
                  <input type="text" class="form-control" placeholder="Nama Distributor" id="dist_name">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi-home"></i>
                    &nbsp;&nbsp;Alamat Kantor Distributor
                  </label>
                  <input type="text" class="form-control" placeholder="Alat Distributor" id="dist_addr">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi-human-greeting"></i>
                    &nbsp;&nbsp;&nbsp;Nama PIC
                  </label>
                  <input type="text" class="form-control" placeholder="Nama PIC" id="dist_pic">
              </div>
            </div>

            <div class="col-sm-5">
              <div class="form-group">
                  <label>
                    <i class="mdi mdi-phone-classic"></i>
                    &nbsp;&nbsp;&nbsp;Nomor Telepon
                  </label>
                  <input type="text" class="form-control" placeholder="Nomor Telepon" id="dist_private_phone">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi-phone"></i>
                    &nbsp;&nbsp;&nbsp;Nomor Kantor
                  </label>
                  <input type="text" class="form-control" placeholder="Nomor Kantor" id="dist_office_phone">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi-email-outline"></i>
                    &nbsp;&nbsp;&nbsp;Email
                  </label>
                  <input type="text" class="form-control" placeholder="Email" id="dist_mail">
              </div>
            </div>

            <div class="col-sm-1">
            </div>
          </form>

          <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 9%; margin-bottom: 2%;" id="save_data_dist"> Simpan Data </button>
        </div>
      </div>
    </div>

    </div>
</div>

<script type="text/javascript">
  var initApps = function()
  {

  };

  var url = "API_admin/apiadmin.php";

  $(document).ready(initApps);
  $("#save_data_dist").click(saveDataDist);


  function saveDataDist()
  {
    var dist_name = document.getElementById('dist_name').value;
    var dist_addr = document.getElementById('dist_addr').value;
    var dist_pic  = document.getElementById('dist_pic').value;
    var dist_private_phone = document.getElementById('dist_private_phone').value;
    var dist_office_phone = document.getElementById('dist_office_phone').value;
    var dist_mail         = document.getElementById('dist_mail').value;

    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqstoredistdat"+"&dist_name="+dist_name+"&dist_addr="+dist_addr+"&dist_pic="+dist_pic+"&dist_private_phone="+dist_private_phone+"&dist_office_phone="+dist_office_phone+"&dist_mail="+dist_mail,
        cache     : false,
        success   : function(JSONObject)
        {
          for(var key in JSONObject)
          {
            if(JSONObject.hasOwnProperty(key))
            {
              if((JSONObject[key]["type"])==="resstoredistdat")
              {
                if((JSONObject[key]["state"])==="success")
                {
                  alert("Penyimpanan data berhasil");
                  document.getElementById('dist_name').value="";
                  document.getElementById('dist_addr').value="";
                  document.getElementById('dist_pic').value="";
                  document.getElementById('dist_private_phone').value="";
                  document.getElementById('dist_office_phone').value="";
                  document.getElementById('dist_mail').value="";
                }
                else
                {
                  alert("Penyimpanan data tidak berhasil");
                }
              }
            }
          }
        }
    });
    return false;
  }

</script>
