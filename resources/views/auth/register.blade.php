<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration | Digital cards</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <!-- toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/custom.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@200;300;400;500;600;700&family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Exo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Expletus+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,500;1,700&display=swap');

        body{
            font-family: 'Exo', sans-serif;;
        }
    </style>
</head>
<body class="hold-transition register-page">
<div class="register-box" style="padding-top: 40px;">
    <div class="card">
        <div class="card-body login-card-body">
            <div class="login-logo">
                <a href="">
                    <img src="{{asset('assets/dist/img/main-logo.svg')}}" alt="">
                </a>
            </div>
            <div class="login-header">
                <h2>Create Account</h2>
                <p class="login-box-msg">You need to enter proper information to register here</p>
            </div>

            <form action="{{route('register-store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Company name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="company_name" placeholder="Enter your company name">
                    @error('name')
                        <small id="name_error" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Your email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter your company email">
                    @error('email')
                        <small id="email_error" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">your Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                    @error('password')
                    <small id="password_error" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="company_logo">Company logo</label>
                    <input type="file" name="logo" class="form-control" id="company_logo" accept=".jpg,.jpeg,.png">
                    <br>
                    <img id="imagePreview" style="display: none;" class="img-thumbnail" src=""  alt="technology_icon" />

                    @error('logo')
                    <small id="logo_error" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="form-check">
                            <input type="checkbox" name="terms_conditions" class="form-check-input" id="terms_conditions">
                            <label class="form-check-label" for="terms_conditions">I Accept Terms & Conditions of Digital Card</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">

                    </div>
                    <!-- /.col -->
                </div>
                <div class="social-auth-links text-center mb-3">
                    <div class="common-btn">
                        <button type="submit" class="custom-btn">Register</button>
                    </div>
                    <p class="text-center mt-3">Already you are logged in ? <a href="{{route('login')}}">Login</a></p>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- toaster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
    @if(Session::has('warning'))
        toastr.options ={ "closeButton" : true, "progressBar" : true }
        toastr.warning("{{ session('warning') }}");
    @endif
        @if(Session::has('error'))
        toastr.options ={ "closeButton" : true, "progressBar" : true }
    toastr.error("{{ session('error') }}");
    @endif
</script>


<script>
    let photo;
    $('#company_logo').on('change',function(e){
    let file = e.target.files[0];
    let reader = new FileReader();
    reader.onloadend =() =>{
    photo = reader.result;
    $('#imagePreview').attr('src',photo);
    document.getElementById("imagePreview").style.display = "block";
    }
    reader.readAsDataURL(file);
    });
</script>
</body>
</html>

