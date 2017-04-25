var initApps = function()
{
      $("#logout").click(logout);
}

var url = "API_admin/apiadmin.php";

$(document).ready(initApps);

function logout()
{
   $.ajax
   ({
      type     : "POST",
      url      : url,
      dataType : "JSON",
      data     : "type=reqlogout",
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]["type"]==="reslogout")
               {
                  var destination = JSONObject[key]["destination"];
                  document.location.href=destination;
               }
            }
         }
      }
   });
   return false;
}
