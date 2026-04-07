<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1, viewport-fit=cover user-scalable=no" />
    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/style.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/fonts/css/fontawesome-all.min.css') }}">
    <link rel="manifest" href="{{ asset('frontend/pwa/_manifest.json') }}"
        data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/pwa/app/icons/icon-192x192.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Anek+Kannada:wght@100..800&family=Anek+Latin:wght@100..800&display=swap"
        rel="stylesheet">
    @yield('style')

    <style>
        .new-family {
            font-family: 'Anek Kannada', sans-serif !important;
        }

        #footer-bar a {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding-top: 20px;
        }
        .bg-highlight{
            background-color: #1f4e79 !important;
        }
    </style>
</head>

<body class="theme-light" data-highlight="blue2">

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">

        @include('vehiclepwa.layout.top-navigation')
        @include('vehiclepwa.layout.bottom-navigation')

        <div class="page-content">
            <!-- <div class="page-title page-title-large" style="margin: 20px 20px 12px 20px;">
                <div style="height:60px"></div>
                <h2>
                    <a href="#" data-back-button=""><i class="fa fa-arrow-left"></i></a> Dashboard
                </h2>
                <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img"
                    data-src="images/avatars/5s.png"></a>
            </div> -->
            <div class="page-title page-title-small">
                <h2>
                    <!-- <a href="#" data-back-button=""><i class="fa fa-arrow-left"></i></a> @yield('heading') -->
                    <a href="#" data-back-button="" style="padding-right: 5px;"><i class="fa fa-arrow-left"></i></a>
                    {{ \Illuminate\Support\Str::limit($__env->yieldContent('heading'), 14, '...') }}
                </h2>
                <div class="position-absolute" style="z-index: 10;right: 70px;top: 8px;">
                   


                </div>
                <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img entered loaded"
                    data-src="images/avatars/5s.png" data-ll-status="loaded"
                    style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTY6qtMj2fJlymAcGTWLvNtVSCULkLnWYCDcQ&s');"></a>
            </div>
            <div class="card header-card shape-rounded" data-card-height="210">
                <div class="card-overlay bg-highlight opacity-95"></div>
                <div class="card-overlay dark-mode-tint"></div>
                <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
            </div>
          
          
            @yield('content')

            <div class="footer" >
                @include('vehiclepwa.layout.footer')
            </div>

        </div>

        <div id="menu-main" class="menu menu-box-right menu-box-detached rounded-m" data-menu-width="260"
             data-menu-effect="menu-over">
             @include('vehiclepwa.layout.sidebar')
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/pwa/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/pwa/scripts/custom.js') }}"></script>
    @yield('script')
    <script>
        function setLang(lang) {
            window.location.href = "{{ url('/local') }}/" + lang;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".s-alrt").fadeTo(2000, 500).fadeOut(1000, function () {
                $(".s-alrt").fadeOut(1000);
            });
        });
    </script>

</body>