<!doctype html>
<html lang="en">
  <head>
  	<title>الوقار | تسجيل الدخول</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/js/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('assets/loginassets/css/style.css') }}">
      <link href="{{ asset('assets/css/vendors.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
	</head>
	<body class="img js-fullheight" style="background-image: url({{ asset('assets/loginassets/images/bg.jpg') }});">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">الكنز | مسؤوول</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">هل لديك حساب</h3>
		      	<form action="#" class="signin-form">
		      		<div class="form-group">
		      			<input type="email" class="form-control" id="email" placeholder="الرقم" required>
		      		</div>
	            <div class="form-group">
	              <input id="password" type="password" class="form-control" placeholder="كلمة السر" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="button" onclick="preformLogin()" class="form-control btn btn-primary submit px-3">تسجيل الدخول</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">تذكرني
                              <input type="checkbox" id="remember_me" checked>
                              <span class="checkmark"></span>
                        </label>
                    </div>
                <div class="w-50 text-md-right">
                    <a href="{{ route('forgetPassword') }}" style="color: #fff">نسيت كلمت السر</a>
                </div>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center">
{{--	          	<a href="{{ route('teacher.login.view') }}" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>محفظ</a>--}}
{{--	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>--}}
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('assets/loginassets/js/jquery.min.js') }}"></script>
{{--    <script src="{{ asset('assets/loginassets/js/popper.js') }}"></script>--}}
    <script src="{{ asset('assets/loginassets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/loginassets/js/main.js') }}"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script>
        function preformLogin(){
            let data = {
                email:document.getElementById('email').value,
                password:document.getElementById('password').value,
                remember_me:document.getElementById('remember_me').checked,
            };
            axios.post('/panel/admin/login', data)
                .then(function (response) {
                    console.log(response);
                    showConfirm(response.data.message, true);
                    window.location.href = '{!! route('dashboard') !!}';
                })
                .catch(function (error) {
                    console.log(error.response.data);
                    showConfirm(error.response.data.message, false);
                });
        }
        function showConfirm(message, status){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            if (status){
                toastr.success(message);
            }else
                toastr.error(message);
        }

    </script>
	</body>
</html>

