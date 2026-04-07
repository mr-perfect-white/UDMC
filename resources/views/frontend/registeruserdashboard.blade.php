@extends('frontend.registeruser.app')
@section('title') Dashboard @endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .asset-card {
            color: #fff;
            border-radius: 12px;
            padding: 18px;
            position: relative;
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            /* Important */
            display: flex;
            /* Important */
            align-items: center;
            /* Vertical alignment */
        }


        .asset-card:hover {
            transform: translateY(-5px);
        }

        .asset-icon {
            font-size: 32px;
            opacity: 0.9;
        }

        .asset-count {
            font-size: 28px;
            font-weight: 700;
        }

        .asset-text {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Card Colors */
        .bg-roads {
            background: linear-gradient(45deg, #2c3e50, #34495e);
        }

        .bg-drains {
            background: linear-gradient(45deg, #2980b9, #3498db);
        }

        .bg-lakes {
            background: linear-gradient(45deg, #1abc9c, #16a085);
        }

        .bg-parks {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
        }

        .bg-toilets {
            background: linear-gradient(45deg, #8e44ad, #9b59b6);
        }

        .bg-skywalk {
            background: linear-gradient(45deg, #d35400, #e67e22);
        }

        .bg-bus {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
        }

        .bg-schools {
            background: linear-gradient(45deg, #f39c12, #f1c40f);
        }

        .bg-playgrounds {
            background: linear-gradient(45deg, #16a085, #1abc9c);
        }

        .bg-parking {
            background: linear-gradient(45deg, #2c3e50, #4ca1af);
        }

        .bg-community {
            background: linear-gradient(45deg, #7f8c8d, #95a5a6);
        }

        .bg-phc {
            background: linear-gradient(45deg, #e74c3c, #ff6b6b);
        }

        .bg-hospital {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
        }

        .bg-crematorium {
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        }

        .bg-office {
            background: linear-gradient(45deg, #34495e, #2c3e50);
        }

        .filter-select {
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
        }

        .filter-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 6px rgba(13, 110, 253, 0.25);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row d-flex justify-content-end">
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="home-item" href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"> Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Container-fluid starts-->
    <div class="container-fluid general-widget " style="margin-bottom: 160px;">
        <div class="row">
             <h2>Welcome {{ $user->name }}</h2>
            <div class="col-sm-4 col-xl-4 col-lg-4">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">Total Tickets</h6>
                                <h3 class="mb-0 counter">0 </h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#ffcd21;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-secondary" role="progressbar" style="width: 75%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4 col-lg-4">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">Active Tickets</h6>
                                <h3 class="mb-0 counter">0</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#9ace3e;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-success" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4 col-lg-4">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">completed</h6>
                                <h3 class="mb-0 counter">0</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#7366ff;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-primary" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card o-hidden">
                    <div class="card-body">
                        <table class="table table-bordered custom-table mb-0">
                <tr>
                    <th>Application ID</th>
                    <td> {{ $user->application_id }}</td>
                </tr>
                <tr>
                    <th> Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                 <tr>
                    <th> Email</th>
                    <td>{{ $user->email  }}</td>
                </tr>
                 <tr>
                    <th> Phone</th>
                    <td>{{ $user->mobile }}</td>
                </tr>
                <tr>
                    <th>Property Type</th>
                    <td>{{ $user->property_type }}</td>
                </tr>
                <tr>
                    <th>Built-up Area</th>
                    <td>{{ $user->built_up_area }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $user->site_address }}</td>
                </tr>
                <tr>
                    <th>Remaining Waste</th>
                    <td>0.00 ton</td>
                </tr>
            </table>
                      
                    </div>
                </div>
            </div>

        

 





<!-- <a href="{{ route('registeruser.logout') }}">Logout</a> -->

        </div>
        <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->
@endsection

@section('script')
@endsection