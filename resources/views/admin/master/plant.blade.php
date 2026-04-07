@extends('admin.layout.app')
@section('title') Plant Add @endsection

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
    display: flex;
    align-items: center;
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

.status-badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
}

.status-pending {
    background-color: #ffc107;
    color: #000;
}

.status-completed {
    background-color: #28a745;
    color: #fff;
}

.action-btn {
    border: none;
    background: transparent;
    font-size: 1.2rem;
    margin: 0 3px;
    cursor: pointer;
}

.action-btn.view {
    color: #0d6efd;
}

.action-btn.edit {
    color: #198754;
}

.action-btn:hover {
    opacity: 0.7;
}

.value {
    font-size: 30px;
    font-weight: 600;
    margin-left: 15px;
}

.add-issue-container {
    text-align: right;
    margin-bottom: 15px;
    margin-right: 23px;
}

.issue {
    padding: 10px;
    font-size: 30px;
    margin-left: 5px;
    margin-top: 5px;
}

.btn-add {
    background-color: #6c63ff;
    color: white;
    font-weight: 500;
    margin-right: 20px;
}

.btn-add:hover {
    background-color: #5848d9;
    color: white;
}

.card1 {
    text-align: center;
    padding: 14px;
}

.card1 h5 {
    font-size: 22px !important;
}

.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 26px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked+.slider {
    background-color: #2196F3;
}

input:checked+.slider:before {
    transform: translateX(24px);
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row align-items-center">

            <div class="col-12 col-sm-6">
                <h3>Plant Add</h3>
            </div>

            <div class="col-12 col-sm-6 text-sm-end mt-2 mt-sm-0">
                <a href="{{ route('plant.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Plant
                </a>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle" id="data-source-1"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:10%">Sl.no</th>
                                    <th style="width:20%;">Owner Name</th>
                                    <th style="width:20%">Name</th>
                                    <th style="width:20%">Email</th>
                                    <th style="width:20%">Address</th>
                                    <th style="width:20%">Ward ID</th>
                                    <th style="width:15%">Longitude</th>
                                    <th style="width:15%">Latitude</th>


                                    <th style="white-space: nowrap;">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plantdeatils as $plant)
                                <tr>

                                    <td>{{$plant->id}}</td>
                                    <td>{{$plant->owner_name}}</td>
                                    <td>{{$plant->plant_name}}</td>
                                    <td>{{$plant->email}}</td>
                                    <td>{{$plant->address}}</td>
                                    <td>{{$plant->ward_id}}</td>
                                    <td>{{$plant->longitude}}</td>
                                    <td>{{$plant->latitude}}</td>
                                    <td>
                                        <form action="{{ route('plants.toggle', $plant->id) }}" method="POST">
                                            @csrf
                                            @if($plant->status == 1)
                                            <button class="btn btn-success btn-sm">Active</button>
                                            @else
                                            <button class="btn btn-danger btn-sm">Inactive</button>
                                            @endif
                                        </form>

                                    </td>




                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Submitted Successfully!',
    text: @json(session('success'))
});
</script>
@endif

<script>

</script>
@endsection