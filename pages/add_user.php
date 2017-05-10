<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Tambah User</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Entry Tambah User
          </h4>

          <hr style="border-top: 1px solid #e5e4e4;"/>

          <form role="form">
              <div class="form-group">
                  <label>
                    <i class="mdi mdi-account-outline"></i>
                    &nbsp;&nbsp;Username
                  </label>

                  <input type="text" class="form-control" placeholder="Username" id="username" autocomplete="off">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi  mdi mdi-package"></i>
                    &nbsp;&nbsp;Password
                  </label>
                  <input type="password" class="form-control" placeholder="Password" id="password" autocomplete="off">
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi mdi-wallet"></i>
                    &nbsp;&nbsp;&nbsp;Level User
                  </label>
              </div>

              <div class="form-group">
                 <select class="form-control select2" id="level_user">
                    <option>Pilihan</option>
                    <option value="admin">Admin</option>
                    <option value="ownerfield">Owner</option>
                    <option value="eo">EO</option>
                </select>
                <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 0%; margin-bottom: 2%;" id="save_create_data"> Simpan Data </button>
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
    //TAPIGETALLPRODIST();
    //TAPIORDERPRODIST();
  };

  var url = "API_admin/apiadmin.php";

  $(document).ready(initApps);
  $("#save_create_data").click(saveDataDist);


  function saveDataDist()
  {
    var username  = document.getElementById('username').value;
    var password  = document.getElementById('password').value;
    var level_user= document.getElementById('level_user').value;

    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqadduser"+"&username="+username+"&password="+password+"&level_user="+level_user,
        cache     : false,
        success   : function(JSONObject)
        {
          for(var key in JSONObject)
          {
            if(JSONObject.hasOwnProperty(key))
            {
              if((JSONObject[key]["type"])==="resadduser")
              {
                if((JSONObject[key]["state"])==="success")
                {
                  alert("Penyimpanan data berhasil");
                  document.getElementById('username').value="";
                  document.getElementById('password').value="";
                  document.getElementById('level_user').value="";
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

  function TAPIORDERPRODIST()
  {
     $.ajax
     ({
         type      : "POST",
         url       : url,
         dataType  : "JSON",
         data      : "type=reqorderdistpro"+"&futsal_code=1234"+"&nominal=20000"+"&id_product=1",
         cache     : false,
         success   : function(JSONObject)
         {
           console.log(JSONObject);
         }
     });
     return false;
  }

</script>
