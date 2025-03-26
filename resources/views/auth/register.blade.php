<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>نظام ادارة المدارس | تسجيل الدخول </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        <!--=================================
 login-->

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-image: url(assets/images/login-bg.jpg);">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg"
                        style="background-image: url(images/login-inner-bg.jpg);">
                        <div class="login-fancy">
                            <h2 class="text-white mb-20">Hello world!</h2>
                            <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose
                                responsive template along with powerful features.</p>
                            <ul class="list-unstyled  pos-bot pb-30">
                                <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a>
                                </li>
                                <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">تسجيل الدخول</h3>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">الأسم*</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="email">البريد الالكتروني*</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">كلمة المرور *</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="password-confirm">تاكيد كلمة المرور * </label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="section-field">
                                    <div class="remember-checkbox mb-30">
                                        <input type="checkbox" class="form-control" name="two" id="two" />
                                        <label for="two"> تذكرني</label>
                                        <a href="#" class="float-right">هل نسيت كلمةالمرور ؟</a>
                                    </div>
                                </div>
                                <div class="d-flex text-center justify-content-center">
                                    <h6 class="text-secondary"> هل لديك حساب بالفعل اذهب الي <i class="fa fa-arrow-left"> </i> </h6>
                                    <a class="ml-1 pt-1" style="color: #84ba3f" href="{{ route('login') }}">Login</a>
                                </div>
                                
                                <button class="button"><span>دخول</span><i class="fa fa-check"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Register -->

    </div>
    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>

    <!-- chart -->
    <script src="{{ asset('assets/js/chart-init.js') }}"></script>
    <!-- calendar -->
    <script src="{{ asset('assets/js/calendar.init.js') }}"></script>
    <!-- charts sparkline -->
    <script src="{{ asset('assets/js/sparkline.init.js') }}"></script>
    <!-- charts morris -->
    <script src="{{ asset('assets/js/morris.init.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <!-- sweetalert2 -->
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <!-- toastr -->
    @yield('js')
    <script src="{{ asset('assets/js/toastr.js') }}"></script>
    <!-- validation -->
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <!-- lobilist -->
    <script src="{{ asset('assets/js/lobilist.js') }}"></script>
    <!-- custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
