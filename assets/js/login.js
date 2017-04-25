var url = "API_admin/apiadmin.php";

var initApps = function()
{
   $("#btn_enter").click(chkLogin);

};

$(document).ready(initApps);


function chkLogin()
{
   var user = document.getElementById('username').value;
   var pass = document.getElementById('password').value;

   $.ajax
   ({
      type     : "POST",
      url      : url,
      dataType : "JSON",
      data     : "type=reqchklogin"+"&user="+user+"&pass="+pass,
      cache    : false,
      success  : function(JSONObject)
      {
         for(var key in JSONObject)
         {
            if(JSONObject.hasOwnProperty(key))
            {
               if(JSONObject[key]['type']==='reschklogin')
               {
                  if(JSONObject[key]['success']==='true')
                  {
                     document.location.href="main";
                  }
                  else
                  {
                     alert("username atau password tidak benar. Mohon ulangi kembali. Terima kasih");
                  }
               }
            }
         }
      }
   });
   return false;
}
