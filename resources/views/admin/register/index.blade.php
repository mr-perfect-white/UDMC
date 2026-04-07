@extends('admin.layout.app')
@section('title') Application List @endsection

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
    display: inline-block;
}

.status-pending {
    background-color: #ffc107;
    color: #000;
}

.status-approved {
    background-color: #28a745;
    color: #fff;
}

.status-rejected {
    background-color: #dc3545;
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
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                    Register List
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div id="qrModal"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:9999;">

    <div style="background:#fff; padding:20px; width:300px; margin:10% auto; text-align:center; border-radius:10px;">

        <h4>QR Code</h4>

        <img id="qrImage" src="" width="200" style="margin:10px 0;">

        <br>
        <button class="btn btn-danger btn-sm" onclick="closeQR()">Close</button>
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
                                    <th style="width:20%">Name</th>
                                    <th style="width:20%">Mobile</th>
                                    <th style="width:20%">Email</th>
                                    <th style="width:15%">property_type</th>
                                    <th style="width:15%">Ward</th>
                                    <th style="width:20%;white-space: nowrap;">application_id </th>
                                    <th style="white-space: nowrap;">plant_id</th>
                                    <th>qr_code</th>
                                    <th>pdf_file</th>
                                    <th style="white-space: nowrap;">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($register as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->property_type}}</td>
                                    <td>{{$user->ward_id}}</td>
                                    <td>{{$user->application_id}}</td>
                                    <td>{{$user->plant_id}}</td>
                                    <td>
                                        @if($user->qr_code)

                                        <button class="btn btn-success btn-sm" onclick="toggleQR({{ $user->id }})">
                                            View QR
                                        </button>

                                        <div id="qr-{{ $user->id }}" style="display:none; margin-top:10px;">
                                            <img src="{{ asset($user->qr_code) }}" width="100">
                                        </div>

                                        @else
                                        <span class="text-muted">Not Generated</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->pdf_file)
                                        <a href="{{ asset($user->pdf_file) }}" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            View PDF
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.register.approve', $user->id) }}" method="POST">
                                            @csrf

                                            <button type="button"
                                                class="btn btn-sm {{ $user->status == 'pending' ? 'btn-warning' : 'btn-secondary' }}"
                                                disabled>
                                                Pending
                                            </button>

                                            <button type="submit"
                                                class="btn btn-sm {{ $user->status == 'approved' ? 'btn-success' : 'btn-outline-success' }}"
                                                {{ $user->status == 'approved' ? 'disabled' : '' }}>
                                                Active
                                            </button>

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
@endsection
<script>
function showQR(src) {
    document.getElementById('qrImage').src = src;
    document.getElementById('qrModal').style.display = 'block';
}

function closeQR() {
    document.getElementById('qrModal').style.display = 'none';
}
</script>

<script>
function toggleQR(id) {
    let qrDiv = document.getElementById('qr-' + id);

    if (qrDiv.style.display === "none") {
        qrDiv.style.display = "block";
    } else {
        qrDiv.style.display = "none";
    }
}
</script>