<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Koordinator Migrant Shop</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/images/icon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" href="/vendor/pnotify/pnotify.custom.css" />
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="formLogin" class="login100-form validate-form" method="POST">
          {{ csrf_field() }}
          <span class="login100-form-title p-b-26">
						Admin
					</span>
					<span class="login100-form-title p-b-48">
						<!-- <img src="/images/icon.png" width="80" height="80"> -->
            Migrant Shop
					</span>

					<div class="wrap-input100">
						<input class="input100" type="email" name="email" required>
						<span class="focus-input100" data-placeholder="Email | ex. koord@gmail.com"></span>
					</div>

					<div class="wrap-input100">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" required>
						<span class="focus-input100" data-placeholder="Password | ex. Koordinator123?!"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-50">
						<!-- <span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="#">
							Sign Up
						</a> -->
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/daterangepicker/moment.min.js"></script>
	<script src="/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/js/main.js"></script>
  <script src="/vendor/pnotify/pnotify.custom.js"></script>

  <script type="text/javascript">

  /*===================================================================
  [ Login ]*/
    var formLogin = $('#formLogin');

      formLogin.submit(function (e) {
          e.preventDefault();

          $.ajax({
              url:'/koordinator/loginKoordinator',
              type:formLogin.attr('method'),
              data:formLogin.serialize(),
              dataType:"json",
              success: function( res ){
                  if(res.error == 1){
                    if(res.message.email != null){
                      new PNotify({
                          title: 'Alert!',
                          text: res.message.email,
                          type: 'warning',
                          icon: "fa fa-warning",
                          delay:1500
                      })
                    }
                    if(res.message.password != null){
                      new PNotify({
                          title: 'Alert!',
                          text: res.message.password,
                          type: 'warning',
                          icon: "fa fa-warning",
                          delay:1500
                      })
                    }
                  }else if(res.error == 0){
                      new PNotify({
                          title: 'Success',
                          text: 'Login Success <br><b><i>' + res.email,
                          type: 'success',
                          icon: "fa fa-check",
                          delay:500,
													after_close: function(){
															window.location.href = "{{ route('dashboardKoordinator') }}";
													}
                      })
                  }else{
                      new PNotify({
                        title: 'Failed',
                        text: 'Login Failed, ' + res.message,
                        type: 'error',
                        icon: "fa fa-times",
                        delay:500
                      })
                  }

              }
          });
      });


  //key f5
  document.onkeydown = fkey;
  document.onkeypress = fkey
  document.onkeyup = fkey;

  var wasPressed = false;

  function fkey(e){
          e = e || window.event;
         if( wasPressed ) return;

          if (e.keyCode == 116) {
               $('.input100').val('');
               wasPressed = true;
          }else {

          }
   }
  </script>
</body>
</html>
