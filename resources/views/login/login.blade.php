<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dev.techneinfosys.com/html/wedash/demo/pages/authentication-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Oct 2023 12:03:52 GMT -->

<head>
    <title>Login</title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Techne infosys" />

    <!-- Favicon icon -->
    {{-- <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" /> --}}

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="#" id="rtl-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">

</head>

<body class="theme-1">


    <div class="auth-wrapper auth-v2 ">
        <div class="auth-content">
            <div class="authentication-inner row m-0">
                <div class="d-none d-lg-block col-lg-7 col-xl-8 p-0 img-side">
                    <img class="img-fluid" width="100%" src="../assets/images/auth/using-laptop-gray-wall.jpg"
                        alt="happy young woman sitting on the floor using laptop on gray wall">
                </div>
                <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                    <div class="w-px-400 mx-auto">
                        <h4 class="mb-2">Welcome </h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                              <form action="{{route('authenticate')}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Enter Email address</label>
                                    <input type="email" required  class="form-control" name='email' placeholder="Email address">
                                    @if ($errors->has('user_email'))<p style="color:red;">{!!$errors->first('user_email')!!}</p>@endif
                                  </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Enter Password</label>
                                    <input type="password" required class="form-control" name="password" placeholder="Password">
                                    @if ($errors->has('user_password'))<p style="color:red;">{!!$errors->first('user_password')!!}</p>@endif
                                </div>
                                @if (Session::has('error'))<p style="color:red;">{{Session::get('error')}}</p>@endif
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-block mt-2">
                                      Login
                                    </button>
                                </div>

                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
 
</html>
