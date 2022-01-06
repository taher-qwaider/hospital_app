<!doctype html>
<html lang="en">
  <head>
  	<title>الوقار | تغيير كلمة المرور</title>
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
		      	<h3 class="mb-4 text-center">أدخل الإميل </h3>
		      	<form action="#" class="signin-form">
		      		<div class="form-group">
		      			<input type="email" class="form-control" id="email" placeholder="الإميل" required>
		      		</div>

	            <div class="form-group">
	            	<button type="button" onclick="preformLogin()" class="form-control btn btn-primary submit px-3">تسجيل الدخول</button>
	            </div>
	          </form>
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
            };
            axios.post('/panel/admin/forgetPassword', data)
                .then(function (response) {
                    console.log(response);
                    showConfirm(response.data.message, true);
                    {{--window.location.href = '{!! route('dashboard') !!}';--}}
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

