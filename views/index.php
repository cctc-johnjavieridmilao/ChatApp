<!DOCTYPE html>
<html>
<head>
	<title>CHAT APP BY JHAY</title>
	<?php include 'helpers/header.php'; ?>
</head>
<body>
   
 <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2" style="font-size: 40px;font-weight: bold;">
                                           CHAT SYSTEM
                                        </h4>
                                    </div>
                                    <form class="">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="Uname" id="Uname" placeholder="Username" type="text"
                                                        class="form-control"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="password" id="password" placeholder="Password here..."
                                                        type="password" class="form-control"></div>
                                            </div>
                                        </div>
                                        <!--  <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Keep me logged in</label></div> -->
                                    </form>
                                    <!-- <div class="divider"></div> -->

                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="float-left"><a href="javascript:void(0);"
                                            class="btn-lg btn btn-link" id="Register">Register</a></div>
                                    <div class="float-right">
                                        <button class="btn btn-primary btn-lg" onclick="Login()" id="LoginUser">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © JHAYJHAY <?php echo date('Y'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php include 'helpers/jsplugin.php'; ?>
</body>
</html>

<script type="text/javascript">

    function Login() {
        var data = {
            ACTION: 'LOGIN_USER',
            Uname: $('#Uname').val(),
            password: $('#password').val(),
        }

        $.post('../core/ChatController.php', data, function(res) {
          var res = JSON.parse(res);
           if (res.success == 'success') {
              alert('Welcome');
              window.location.href = 'home.php';
              return false;
           } 
           alert(res.error);
        });
    }

	$(function() {
		 $('#Register').click(function() {
		 	 window.location.href = 'register.php';
		 });
	});
</script>