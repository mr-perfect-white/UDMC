<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>Vehicle Login - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/style.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/fonts/css/fontawesome-all.min.css') }}">
    <link rel="manifest" href="{{ asset('frontend/pwa/_manifest.json') }}"
        data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/pwa/app/icons/icon-192x192.png') }}">
    <style>
        .new-family {
            font-family: 'Anek Kannada', sans-serif !important;
        }

        .bg-highlight {
            background-color: #1f4e79 !important;
        }
    </style>
</head>

<body class="theme-light" data-highlight="blue2">

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">

        <div class="page-content">
            <div class="page-title page-title-large"></div>

            <div class="card header-card shape-rounded" data-card-height="210">
                <div class="card-overlay bg-highlight opacity-95"></div>
                <div class="card-overlay dark-mode-tint"></div>
                <div class="card-bg preload-img" data-src="{{ asset('frontend/pwa/images/bbmp.png') }}"></div>
                <div class="position-absolute" style="z-index: 10; right: 40%; top: 10px;">
                    <h2 class="text-white">CDWMS</h2>
                </div>
            </div>

            @if (Session::has('success'))
                <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert"
                        aria-label="Close">&times;</button>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
                    <span><i class="fa fa-times"></i></span>
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert"
                        aria-label="Close">&times;</button>
                </div>
            @endif

            <div class="card card-style mt-5">
                <div class="content">
                    <div class="col-12 ps-0">
                        <div class="text-center" style="position:relative;">
                            <img src="{{ asset('frontend/pwa/images/bbmplogo.png') }}" width="75" height="75"
                                class="rounded-xl">
                        </div>
                    </div>
                </div>

                <div class="content mt-2 mb-0">
                    <h2 class="mb-3 color-dark">Vehicle Login</h2>

                    <form method="POST" action="{{ route('vehicle.login.submit') }}">
                        @csrf

                        <div class="input-style no-borders has-icon validate-field mb-4">
                            <i class="fa fa-phone"></i>
                            <input type="text" class="form-control validate-name @error('mobile') is-invalid @enderror"
                                id="form1a" name="mobile" placeholder="Mobile Number"
                                value="{{ old('mobile') }}" maxlength="10" required>
                            <label for="form1a" class="color-blue-dark font-10 mt-1">Mobile Number</label>
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>
                            <em>(required)</em>
                        </div>

                        @error('mobile')
                            <span class="color-red-dark">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="input-style no-borders has-icon validate-field mb-4 position-relative">
                            <i class="fa fa-lock"></i>
                            <input type="password" class="form-control validate-password @error('password') is-invalid @enderror"
                                id="form3a" placeholder="Password" name="password" required>
                            <label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>
                            <em>(required)</em>

                            <i class="fa fa-eye toggle-password position-absolute"
                                style="top: 18px; right:45px; cursor: pointer;" onclick="togglePassword()"></i>
                        </div>

                        @error('password')
                            <span class="color-red-dark">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <center>
                            <input type="submit"
                                class="btn btn-m mt-4 mb-4 btn-full bg-blue-dark rounded-sm text-uppercase font-900"
                                style="background-color: #3b5998 !important;"
                                value="Login">
                        </center>
                    </form>

                    <div class="divider mt-4 mb-3"></div>

                    <div class="d-flex justify-content-between">
                        <div class="font-900 color-highlight pb-3 text-end text-nowrap">
                            <a href="{{ route('vehicleregistration') }}" class="p-2 bg-highlight rounded-sm">
                                Registration
                            </a>
                        </div>

                        <div class="font-900 color-highlight pb-3 text-end text-nowrap">
                            <a href="{{ route('vehicleforgotpassword') }}" class="p-2 bg-highlight rounded-sm">
                                Forgot Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>

              <div class="footer" >
                @include('vehiclepwa.layout.footer')
            </div>

        </div>

    </div>

    <div class="position-fixed" style="top: 11px; right: 3px;">
        <select class="form-control p-0 px-2 m-0" style="border-radius: 8px;"
            onchange="window.location.href = '{{ url('/local') }}/' + this.value;">
            <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>KN</option>
            <option value="kn" {{ App::getLocale() == 'kn' ? 'selected' : '' }}>EN</option>
        </select>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/pwa/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/pwa/scripts/custom.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".s-alrt").fadeTo(2000, 500).fadeOut(1000, function() {
                $(".s-alrt").fadeOut(1000);
            });
        });
    </script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('form3a');
            const toggleIcon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
