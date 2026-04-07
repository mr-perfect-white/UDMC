<header id="header" class="header sticky-top">

    

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-end">
            <a href="#" class="logo d-flex align-items-center me-auto">
                <img src="{{asset('frontendwebsite/img/bbmp.png')}}" alt="">
                <!-- Uncomment the line below if you also wish to use a text logo -->
                <!-- <h1 class="sitename">Medicio</h1>  -->
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="" class="">Home</a></li>
                    <li><a href="##aboutUDMS" class="">About UDMS</a></li>
                    <li><a href="##guidelines" class="">Guidelines</a></li>
                  
                    <li><a href="" class="">Application Status</a></li>
                   
                   
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
           
                <a class="cta-btn pt-2" href="{{ route('register') }}">Apply for Waste Disposal Approval</a>
           
        </div>

    </div>

</header>

<style>
    .header .cta-btn {
        padding: 8px 15px 6px 15px !important;
    }
</style>