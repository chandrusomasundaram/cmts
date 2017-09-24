<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">

    <title>Login</title>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
	      $(document).ready(function(){
            $("#btn_popup").click(function(){
                 $("#myModal").modal('show');
            });
            $("#verify_mail").click(function(){
                var ver_mail = $("#verifyMail").val();
                var datastring = 'email='+ver_mail;
                $.ajax({
                    url: "check_mail.php",
                    type: "POST",
                    data: datastring,
                    success: function(result){
                        $("#myModal").modal('toggle');
                        $('#err_msg').html(result);
                    }
                });
                return false; 
            });
	      });
    </script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
</head>

  <body>

    <div class="container">

      <form class="login-form" id="login_form" method="post" action="login.php">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="email" class="form-control" id="username" name="username" placeholder="Email">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span  class="pull-right">
                    <button id="btn_popup" type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal"> Forgot Password?</button>   
                </span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" value="btn_login" id="btn_login" name="btn_login" type="submit">Login</button>
            <br>
            <div><center><p id="err_msg" style="color:#FF0000;"></p></center></div>
        </div>
      </form> 
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
            <div class="modal-header">
      				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title" id="select-statement-title">Verify Mail</h4>
            </div>
            <div class="modal-body">
              <div id="mailform" class="form-horizontal" role="form">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label" for="verifyMail">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="verifyMail" name="verifyMail" placeholder="Email"/>
                    </div>
                  </div>
                  <div class="form-group">
                      <center><button type="button" id="verify_mail" name="verify_mail" class="btn btn-primary">Verify</button></center>
                  </div>
              </div>      
            </div>
        </div>
    </div>
    </div>
    </div>
  </body>
</html>