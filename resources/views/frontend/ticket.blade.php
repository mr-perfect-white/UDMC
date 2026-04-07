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
           
<div class="container mt-5">

    <div class="card card-custom">
        <div class="card-header bg-primary text-white">
            <h5>Create Ticket</h5>
        </div>

        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
<form method="POST" action="{{ route('registeruser.storeticket') }}" enctype="multipart/form-data">
    @csrf

   

    <!-- Application ID -->
    <div class="mb-3">
        <label>Application ID</label>
        <input type="text" name="application_id" class="form-control"
               value="{{ $user->application_id }}" readonly>
    </div>

    <!-- Name -->
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control"
               value="{{ $user->name }}" readonly>
    </div>

    <!-- Address -->
    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control"
               value="{{ $user->site_address }}" readonly>
    </div>

    <!-- EXTRA FIELDS -->
    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" step="0.01" name="quantity" class="form-control" required>
    </div>
    
<div class="mb-3">
    <label>Latitude</label>
    <input type="text" name="latitude" id="latitude" class="form-control" readonly required>
</div>

<div class="mb-3">
    <label>Longitude</label>
    <input type="text" name="longitude" id="longitude" class="form-control" readonly required>
</div>

<button type="button" onclick="getLocation()" class="btn btn-primary mb-3">
    Get Current Location
</button>
<script>
function getLocation() {

    if (!navigator.geolocation) {
        alert("Geolocation not supported");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
        },
        function(error) {
            console.log(error);

            if (error.code === 1) {
                alert("Permission denied. Please allow location.");
            } else if (error.code === 2) {
                alert("Location unavailable.");
            } else if (error.code === 3) {
                alert("Request timeout.");
            } else {
                alert("Unknown error occurred.");
            }
        }
    );
}
</script>

    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control" required>
    </div>
    

    <button class="btn btn-success w-100">Create Ticket</button>
</form>

        </div>
    </div>

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

