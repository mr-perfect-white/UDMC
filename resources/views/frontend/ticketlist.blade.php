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
.status-badge {
    display: inline-block;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 20px;
    text-transform: capitalize;
    color: #fff;
}

/* Pending */
.status-pending {
    background: linear-gradient(45deg, #f59e0b, #fbbf24);
}

/* Processing */
.status-processing {
    background: linear-gradient(45deg, #3b82f6, #60a5fa);
}

/* Completed */
.status-completed {
    background: linear-gradient(45deg, #10b981, #34d399);
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
                    <h3>User Raised Ticket</h3>
        <div class="row g-4">
            @foreach($tickets as $item)
            

                            <div class="col-lg-3 col-md-4 col-12">
                    <div class="card ticket-card p-3 d-flex flex-column align-items-start">
                        <div class="mb-2">
                            <span class="ticket-label">Requests ID :</span>
                            <span class="ticket-value">{{$item->application_id}}</span>
                        </div>

                        <div class="mb-2">
                            <span class="ticket-label">Quantity :</span>
                            <span class="ticket-value">{{$item->quantity}}</span>
                        </div>

                        <div class="mb-2">
                            <span class="ticket-label">Plant :</span>
                            <span class="ticket-value">Not Assigned</span>
                        </div>

                        <div class="mb-3">
                            <span class="ticket-label">Status :</span>
                            <span class="status-badge 
    {{ $item->status == 'pending' ? 'status-pending' : '' }}
    {{ $item->status == 'processing' ? 'status-processing' : '' }}
    {{ $item->status == 'completed' ? 'status-completed' : '' }}">
    
    {{ ucfirst($item->status) }}
</span>
                        </div>

                        <div class="d-flex flex-column align-items-start mt-1">
                            <a href="" class="btn btn-primary py-1 pt-1 pb-1 d-flex flex-row gap-1" data-bs-original-title="" title="">
                                <span><i class="bi bi-eye-fill"></i></span>
                                <span>View</span>
                            </a>
                        </div>
                    </div>
                </div>
                            
                        @endforeach   
                        
                    </div>
                </div>
                          


        </div>
    </div>

</div>


<!-- footer start-->
@endsection

@section('script')
@endsection