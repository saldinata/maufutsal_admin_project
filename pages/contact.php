<?php
   $phone_number  = null;
   $address       = null;
   $company       = null;
   $email         = null;

   $query         = "SELECT * FROM tbl_web_contact";
   $get_contents  = $db->getAllValue($query);
   if(!empty($get_contents))
   {
      foreach($get_contents as $data_contents)
      {
         $phone_number  = $data_contents['no_telp'];
         $address       = $data_contents['alamat'];
         $company       = $data_contents['perusahaan'];
         $email         = $data_contents['email'];
      }
   }
   else
   {
      $phone_number  = "";
      $address       = "";
      $company       = "";
      $email         = "";
   }
 ?>

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-title-box">
            <h4 class="page-title">Contact Maufutsal</h4>
            <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title" style="font-weight: 300;">
            Data Contact
          </h4>

          <hr style="border-top: 1px solid #e5e4e4;"/>

          <form role="form">
              <div class="form-group">
                  <label>
                    <i class="mdi mdi-account-outline"></i>
                    &nbsp;&nbsp;Nomor Telepon
                  </label>

                  <input type="text" class="form-control" placeholder="Pisahkan dengan tanda koma(,) apabila lebih dari satu kontak" id="contact_phone" autocomplete="off" value="<?php echo $phone_number; ?>" >
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi  mdi mdi-package"></i>
                    &nbsp;&nbsp;Alamat
                  </label>
                  <input type="text" class="form-control" placeholder="Alamat Kantor" id="contact_address" autocomplete="off" value="<?php echo $address; ?>" >
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi mdi-wallet"></i>
                    &nbsp;&nbsp;&nbsp;Email
                  </label>
                  <input type="text" class="form-control" placeholder="Email Perusahaan" id="contact_email" autocomplete="off" value="<?php echo $email; ?>"  >
              </div>

              <div class="form-group">
                  <label>
                    <i class="mdi mdi-human-greeting"></i>
                    &nbsp;&nbsp;&nbsp;Nama Perusahaan
                  </label>
                  <input type="text" class="form-control" placeholder="Nama Perusahaan" id="contact_company" autocomplete="off" value="<?php echo $company; ?>" >

                  <button class="btn btn-success waves-effect waves-light" style="background-color:#61ad18 !important; border: 1px solid #7ab915 !important; margin-top: 3%; margin-left: 0%; margin-bottom: 2%;" id="save_content"> Simpan Data </button>

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

  };

  var url = "API_admin/apiadmin.php";

  $(document).ready(initApps);
  $("#save_content").click(saveContent);


  function saveContent()
  {
     var phone    = document.getElementById('contact_phone').value;
     var address  = document.getElementById('contact_address').value;
     var company  = document.getElementById('contact_company').value;
     var email    = document.getElementById('contact_email').value;

    $.ajax
    ({
        type      : "POST",
        url       : url,
        dataType  : "JSON",
        data      : "type=reqsavecontactcontent"+"&phone="+phone+"&address="+address+"&company="+company+"&email="+email,
        cache     : false,
        success   : function(JSONObject)
        {
          for(var key in JSONObject)
          {
            if(JSONObject.hasOwnProperty(key))
            {
              if((JSONObject[key]["type"])==="ressavecontactcontent")
              {
                if((JSONObject[key]["state"])==="success")
                {
                  alert("Penyimpanan data berhasil");
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
