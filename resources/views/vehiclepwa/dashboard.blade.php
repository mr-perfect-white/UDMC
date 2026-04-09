@extends('vehiclepwa.layout.app')

@section('title') Dashboard @endsection
@section('heading') Dashboard @endsection

@section('style')
<style>
    .mt5 { margin-top: 55px; }

    /* ── Stat cards ── */
    .stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.07);
        text-align: center;
    }

    .stat-card-title {
        font-size: 13px;
        color: #888;
        font-weight: 500;
        margin-bottom: 6px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        line-height: 1;
    }

    .stat-divider {
        height: 1px;
        background: #f0f0f0;
        margin: 10px 0;
    }

    .stat-sub-row {
        display: flex;
        justify-content: space-around;
    }

    .stat-sub-label { font-size: 12px; color: #999; }
    .stat-sub-number { font-size: 16px; font-weight: 600; }

    .color-pickup    { color: #2f6fed; }
    .color-dump      { color: #e53935; }
    .color-completed { color: #198754; }
    .color-pending   { color: #e6a817; }

    /* ── Section label ── */
    .section-label {
        font-size: 13px;
        font-weight: 700;
        color: #2a5780;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 16px 0 10px;
    }

    /* ── Ticket cards ── */
    .ticket-card {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.07);
        height: 100%;
    }

    .ticket-title { font-weight: 600; font-size: 14px; color: #000000bd; }
    .ticket-value { font-size: 13px; color: #666; margin-top: 2px; }

    .status-pill {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .sp-assigned       { background:#fff3cd; color:#664d03; }
    .sp-pickup_scanned { background:#fde8d8; color:#7d3c0f; }
    .sp-pickup_submitted { background:#d6f0ff; color:#0b4a6e; }
    .sp-ready_to_dump  { background:#e2d9f3; color:#4b2e83; }
    .sp-dump_submitted { background:#fff3cd; color:#664d03; }

    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        width: 100%;
        padding: 8px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        text-decoration: none;
        margin-top: 10px;
        color: #fff;
    }
    .btn-pickup { background: #2a5780; }
    .btn-dump   { background: #6f42c1; }

    /* ── Available tickets CTA ── */
    .cta-card {
        background: #2a5780;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        color: #fff;
        margin-bottom: 16px;
        text-decoration: none;
        display: block;
    }
    .cta-card:hover { background: #1f4060; color: #fff; }
    .cta-card .cta-icon { font-size: 32px; margin-bottom: 8px; }
    .cta-card .cta-title { font-size: 16px; font-weight: 700; }
    .cta-card .cta-sub   { font-size: 13px; opacity: 0.8; margin-top: 4px; }
    .ticket-card {
    border-radius: 12px;
    transition: all 0.25s ease;
}

.ticket-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.card-header {
    border-bottom: 1px solid #f1f1f1;
}

.btn-success {
    border-radius: 8px;
    font-weight: 600;
}
</style>
@endsection

@section('content')
<div class="container mt5">

    {{-- ── Stats ── --}}
    <div class="stat-grid">

        <div class="stat-card">
            <div class="stat-card-title">Pickups</div>
            <div class="stat-number color-pickup"></div>
            <div class="stat-divider"></div>
            <div class="stat-sub-row">
                <div>
                    <div class="stat-sub-number color-pending"></div>
                    <div class="stat-sub-label">Pending</div>
                </div>
                <div>
                    <div class="stat-sub-number color-completed"></div>
                    <div class="stat-sub-label">Done</div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-title">Dumps</div>
            <div class="stat-number color-dump"></div>
            <div class="stat-divider"></div>
            <div class="stat-sub-row">
                <div>
                    <div class="stat-sub-number color-pending"></div>
                    <div class="stat-sub-label">Pending</div>
                </div>
                <div>
                    <div class="stat-sub-number color-completed"></div>
                    <div class="stat-sub-label">Done</div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Browse available tickets CTA ── --}}
    <a href="" class="cta-card">
        <div class="cta-icon"><i class="bi bi-collection"></i></div>
        <div class="cta-title">Browse Available Tickets</div>
        <div class="cta-sub">Accept new debris pickup requests</div>
    </a>
   @if($tickets->count())
<div class="row">
@foreach($tickets as $ticket)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card ticket-card h-100 border-0 shadow-sm">

            <!-- Header -->
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-bold text-primary">
                    <i class="bi bi-hash"></i> {{ $ticket->application_id }}
                </span>
                <span class="badge bg-warning text-dark">
                    {{ ucfirst($ticket->status) }}
                </span>
            </div>

            <!-- Body -->
            <div class="card-body">
                <div class="mb-2">
                    <small class="text-muted">Quantity</small>
                    <div class="fw-semibold">{{ $ticket->quantity }}</div>
                </div>

                <div class="mb-2">
                    <small class="text-muted">Location</small>
                    <div>
                        <i class="bi bi-geo-alt text-danger"></i>
                        <span class="small">
                            {{ $ticket->latitude }}, {{ $ticket->longitude }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-white border-0">
                <form method="POST" action="{{ route('vehicle.accept.ticket', $ticket->id) }}">
                    @csrf
                    <button class="btn btn-success w-100">
                        <i class="bi bi-check-circle"></i> Accept Request
                    </button>
                </form>
            </div>

        </div>
    </div>
@endforeach
</div>
@else
    <div class="text-center mt-5">
        <i class="bi bi-inbox display-5 text-muted"></i>
        <p class="mt-2 text-muted">No pending tickets available</p>
    </div>
@endif
    

        <div class="section-label">Vehicle Details</div>

         <div style="background:#fff;border-radius:14px;padding:24px;text-align:center;box-shadow:0 4px 14px rgba(0,0,0,0.07);">
           <div class="container-fluid">
        <div class="">
            <div class="card shadow">
                <div class="card-body">
                    @if($vehicle)
                    
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Vehicle Number</th>
                            <td>{{ $vehicle->vehicle_number }}</td>
                        </tr>
                        <tr>
                            <th>Vehicle Type</th>
                            <td>{{ $vehicle->vehicle_type }}</td>
                        </tr>
                        <tr>
                            <th>Capacity</th>
                            <td>{{ $vehicle->capacity }}</td>
                        </tr>
                        
                        <tr>
                            <th>RC Certificate</th>
                            <td>
                                @if ($vehicle->rc_document)
                                    <a href="{{ asset('storage/' . $vehicle->rc_document) }}" target="_blank">View RC Certificate</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fitness Certificate</th>
                            <td>
                                @if ($vehicle->fitness_certificate)
                                    <a href="{{ asset('storage/' . $vehicle->fitness_certificate) }}" target="_blank">View Fitness Certificate</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        
                       
                        
                        <tr>
                            <th>Owner Aadhaar Number</th>
                            <td>{{ $vehicle->owner_aadhaar_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Owner Aadhaar Photo</th>
                            <td>
                                @if ($vehicle->owner_aadhaar_photo)
                                    <a href="{{ asset('storage/' . $vehicle->owner_aadhaar_photo) }}" target="_blank">View Owner Aadhaar</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Driver Name</th>
                            <td>{{ $vehicle->driver_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Driver Mobile</th>
                            <td>{{ $vehicle->driver_mobile ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Driver Address</th>
                            <td>{{ $vehicle->driver_address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Driver License Number</th>
                            <td>{{ $vehicle->driver_license_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Driver License Photo</th>
                            <td>
                                @if ($vehicle->driver_license_photo)
                                    <a href="{{ asset('storage/' . $vehicle->driver_license_photo) }}" target="_blank">View Driver License</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Driver Aadhaar Number</th>
                            <td>{{ $vehicle->driver_aadhaar_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Driver Aadhaar Photo</th>
                            <td>
                                @if ($vehicle->driver_aadhaar_photo)
                                    <a href="{{ asset('storage/' . $vehicle->driver_aadhaar_photo) }}" target="_blank">View Driver Aadhaar</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                       
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
        </div>

        <div class="row g-3">
          
        </div>
  
        <div class="section-label">Active Tickets</div>
        <div style="background:#fff;border-radius:14px;padding:24px;text-align:center;box-shadow:0 4px 14px rgba(0,0,0,0.07);">
            <i class="bi bi-inbox" style="font-size:32px;color:#ccc;"></i>
            <div style="font-size:14px;color:#888;margin-top:8px;">No active tickets right now.</div>
            <div style="font-size:13px;color:#aaa;margin-top:4px;">Browse available tickets to get started.</div>
        </div>
    
</div>
@endsection

@section('script')
@endsection