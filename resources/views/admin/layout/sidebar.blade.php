<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="#" class="d-flex flex-row align-items-center gap-2"><img
                    class="img-fluid for-light" src="{{asset('/theme/images/small-logo.png') }}" alt=""><img
                    class="img-fluid for-dark" src="{{asset('/theme/images/small-white-logo.png') }}" alt=""><span>Admin
                    - UDMS</span></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid"
                    src="{{asset('/theme/images/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="#"><img class="img-fluid"
                                src="{{asset('/theme/images/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"> </i></div>
                    </li>


                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="
                    {{ route('admin.dashboard') }}">
                            <span><i class="bi bi-house-door-fill"></i></span>
                            <span>Dashboard</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="{{ route('register.index') }}">
                            <span><i class="bi bi-pencil-square"></i></span>
                            <span>Register</span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="">
                            <span><i class="bi bi-ticket-perforated"></i></span>
                            <span>Ticket</span></a>
                    </li>



                    <li class="sidebar-list"><a class="sidebar-link sidebar-title d-flex flex-row gap-2" href="#">
                            <span><i class="bi bi-gear-fill"></i></span><span>Master</span></a>
                        <ul class="sidebar-submenu">

                            <li>
                                <a href="{{ route('plant') }}">
                                    <i class="bi bi-tree-fill"></i> Plant
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('vehicle') }}">
                                    <i class="bi bi-truck-front"></i> Vehicle
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>

            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>