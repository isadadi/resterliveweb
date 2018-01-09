<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RosterLive USU | Login</title>

    <!-- Bootstrap -->
    <link href="<?=base_url("assets/vendors/bootstrap/dist/css/bootstrap.min.css")?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url("assets/vendors/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url("assets/vendors/nprogress/nprogress.css")?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url("assets/vendors/animate.css/animate.min.css")?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url("assets/build/css/custom.min.css")?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>

      <div class="login_wrapper">

        <div class="animate form login_form">
          <section class="login_content">

              <h1>Login Form</h1>
              <div id="alert" style="display:none">
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    Username atau Password Salah.
                  </div>
         </div>
              <div>
                <input type="text" class="form-control us" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="password" class="form-control ps" placeholder="Password" required="" name="password" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" name="submit">Log in</button>
              </div>
              
              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>RosterLive USU</h1>
                  <p>©2017 All Rights Reserved. RosterLive USU by EIGTO. Privacy and Terms</p>
                </div>
              </div>
          </section>
        </div>
      </div>
    </div>
     <script src="<?=base_url("assets/vendors/jquery/dist/jquery.min.js")?>"></script>
     <script type="text/javascript">
        $('.submit').on('click',function(){
            var us = $('.us').val();
            var ps = $('.ps').val();
            $.post("<?=base_url('index.php/login')?>", {username:us, password:ps, submit:1}, function(data){                
              if(data==1){
                  window.location.replace("<?=base_url('fakultas')?>");

              }
              else if(data == 2){
                window.location.replace("<?=base_url('dosen')?>");
              }
              else{
                  $('#alert').prop("style","display:block");
                   $('.us').prop('value','');
                  $('.ps').prop('value','');
              }
            });
        });
     </script>
  </body>
</html>
