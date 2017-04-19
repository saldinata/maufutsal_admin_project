<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Entry Product Distributor</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Entry Data Product Distributor
          </h4>

          <hr style="border-top: 1px solid #e5e4e4;"/>

          <form role="form">
              <div class="form-group">
                  <label>
                    <i class="mdi mdi-account-outline"></i>
                    &nbsp;&nbsp;Code Distributor
                  </label>

                  <input type="text" class="form-control" placeholder="Code Distributor" id="dist_name">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi  mdi mdi-package"></i>
                    &nbsp;&nbsp;Nama Product Distributor
                  </label>
                  <input type="text" class="form-control" placeholder="Nama Produk Distributor" id="dist_product">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi mdi-wallet"></i>
                    &nbsp;&nbsp;&nbsp;Harga
                  </label>
                  <input type="text" class="form-control" placeholder="Harga Produk" id="dist_price">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi-human-greeting"></i>
                    &nbsp;&nbsp;&nbsp;Keterangan
                  </label>
                  <input type="text" class="form-control" placeholder="Keterangan Tambahan" id="dist_note" />

                  <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 0%; margin-bottom: 2%;" id="save_data_dist"> Simpan Data </button>

            </div>
          </form>
        </div>
      </div>
    </div>

    </div>
</div>

<script type="text/javascript">
  var initApps = function()
  {
    TAPIGETALLPRODIST();
  };

  var url = "API_admin/apiadmin.php";

  $(document).ready(initApps);
  $("#save_data_dist").click(saveDataDist);


  function saveDataDist()
  {
    var dist_name     = document.getElementById('dist_name').value;
    var dist_product  = document.getElementById('dist_product').value;
    var dist_price    = document.getElementById('dist_price').value;
    var dist_note     = document.getElementById('dist_note').value;

    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqstoredistpro"+"&dist_name="+dist_name+"&dist_product="+dist_product+"&dist_price="+dist_price+"&dist_note="+dist_note,
        cache     : false,
        success   : function(JSONObject)
        {
          for(var key in JSONObject)
          {
            if(JSONObject.hasOwnProperty(key))
            {
              if((JSONObject[key]["type"])==="resstoredistpro")
              {
                if((JSONObject[key]["state"])==="success")
                {
                  alert("Penyimpanan data berhasil");
                  //document.getElementById('dist_name').value="";
                  document.getElementById('dist_product').value="";
                  document.getElementById('dist_price').value="";
                  document.getElementById('dist_note').value="";
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

  function TAPIGETALLPRODIST()
  {
    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqgetalldistpro",
        cache     : false,
        success   : function(JSONObject)
        {
          console.log(JSONObject);
        }
    });
    return false;
  }

</script>
