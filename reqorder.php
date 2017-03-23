<script src="assets/js/jquery.min.js"></script>

<script>
  var content   = "";

  var initApps  = function()
  {
    getDistOrder();
  };

  function getDistOrder()
  {
    $.ajax
    ({
      type        : "POST",
      url         : "http://www.maufutsal.com/api_mf/development.php",
      dataType    : "JSON",
      data        : "type=reqdistordereg"+"&id_user="+"0"+"&date="+"22/03/2017"+"&nominal="+"5000"+"&quantity="+"1",
      contentType : "application/x-www-form-urlencoded; charset=UTF-8",
      cache       : false,
      success     : function(JSONObject)
      {
        for(var key in JSONObject)
        {
          if(JSONObject.hasOwnProperty(key))
          {
            if(JSONObject[key]["type"]==="resgetdistorder")
            {
              var futsal_name   = JSONObject[key]["futsal_name"];
              var id_user       = JSONObject[key]["id_user"];
              var id_reg        = JSONObject[key]["id_reg"];
              var date          = JSONObject[key]["date"];
              var nominal       = JSONObject[key]["nominal"];
              var quantity      = JSONObject[key]["quantity"];
              var payment_stat  = JSONObject[key]["payment_state"];
              var condition     = JSONObject[key]["condition"];
              var city          = JSONObject[key]["city"];

              content += "<tr>";
              content += "<td  style=\"text-align: center;\">"+futsal_name+"</td>";
              content += "<td style=\"text-align: center;\">"+id_reg+"</td>";
              content += "<td style=\"text-align: center;\">"+city+"</td>";
              content += "<td style=\"text-align: center;\">"+date+"</td>";
              content += "<td style=\"text-align: center;\">"+"IDR "+nominal+"</td>";
              content += "<td style=\"text-align: center;\">"+quantity+"</td>";
              content += "<td style=\"text-align: center;\"><span class=\"label label-danger\">"+payment_stat+"</span></td>";
              content += "<td style=\"text-align: center;\"><button class=\"btn btn-icon waves-effect waves-light btn-default\"> <i class=\"fa fa-eye\"></i></button>&nbsp;&nbsp;&nbsp;";
              content += "<button class=\"btn btn-icon waves-effect waves-light btn-success\"><i class=\"fa fa-check\"></i> </button></td>";
              content += "</tr>"
              $("#list_").append(content);
            }
          }
        }
      }
    });
    return false;
  }

  $(document).ready(initApps);
</script>
