@extends('vehiclepwa.layout.app')
@section('title') Dump Ticket @endsection
@section('heading') Dump Details @endsection

@section('style')
<style>
    .mt5 { margin-top: 55px; }
    .pwa-card { background:#fff; border-radius:16px; padding:20px; box-shadow:0 6px 18px rgba(0,0,0,0.08); margin-bottom:16px; }
    .info-row { display:flex; justify-content:space-between; align-items:flex-start; padding:10px 0; border-bottom:1px solid #f0f0f0; gap:8px; }
    .info-row:last-child { border-bottom:none; }
    .info-label { font-size:13px; color:#888; font-weight:500; min-width:110px; }
    .info-value { font-size:14px; color:#222; font-weight:600; text-align:right; word-break:break-word; }
    .status-badge { display:inline-block; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; }
    .s-ready_to_dump  { background:#e2d9f3; color:#4b2e83; }
    .s-dump_submitted { background:#fff3cd; color:#664d03; }
    .s-completed      { background:#d1e7dd; color:#0f5132; }
    .section-heading { font-size:13px; font-weight:700; color:#2a5780; text-transform:uppercase; letter-spacing:.6px; margin-bottom:14px; display:flex; align-items:center; gap:7px; }
    .photo-preview-grid { display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; }
    .photo-thumb { width:80px; height:80px; object-fit:cover; border-radius:10px; border:1.5px solid #c6d4e8; }
    .otp-input { width:100%; padding:14px; font-size:22px; font-weight:700; letter-spacing:10px; text-align:center; border:2px solid #c6d4e8; border-radius:12px; outline:none; transition:border .2s; }
    .otp-input:focus { border-color:#6f42c1; }
    .btn-pwa-primary { width:100%; padding:14px; background:#2a5780; color:#fff; border:none; border-radius:12px; font-size:15px; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none; transition:background .2s; margin-top:12px; }
    .btn-pwa-primary:hover { background:#1f4060; color:#fff; }
    .btn-pwa-success { width:100%; padding:14px; background:#6f42c1; color:#fff; border:none; border-radius:12px; font-size:15px; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:background .2s; margin-top:12px; }
    .btn-pwa-success:hover { background:#5a32a3; }
    .btn-directions { display:inline-flex; align-items:center; gap:6px; padding:10px 16px; background:#e8f0f8; color:#2a5780; border-radius:10px; font-size:14px; font-weight:600; text-decoration:none; border:1.5px solid #c6d4e8; margin-top:8px; }
    .btn-directions:hover { background:#d0e2f5; color:#2a5780; }
</style>
@endsection

@section('content')
<div class="container mt5">

@php $status = $ticket->status; @endphp

{{-- ALWAYS VISIBLE — Ticket + Plant info --}}
<div class="pwa-card">
    <div class="section-heading"><i class="bi bi-ticket-detailed"></i> Ticket Info</div>
    <div class="info-row"><span class="info-label">Ticket #</span><span class="info-value">{{ $ticket->ticket_number }}</span></div>
    <div class="info-row"><span class="info-label">Owner</span><span class="info-value">{{ $ticket->user?->name ?? '-' }}</span></div>
    <div class="info-row"><span class="info-label">Pickup address</span><span class="info-value">{{ $ticket->site_address ?? '-' }}</span></div>
    <div class="info-row"><span class="info-label">Quantity</span><span class="info-value">{{ number_format((float)$ticket->estimated_quantity,2) }} units</span></div>
    <div class="info-row">
        <span class="info-label">Scheduled</span>
        <span class="info-value">
            @if ($ticket->scheduled_date)
                {{ \Carbon\Carbon::parse($ticket->scheduled_date)->format('d M Y') }}
                {{ $ticket->scheduled_time ? '· '.\Carbon\Carbon::parse($ticket->scheduled_time)->format('h:i A') : '' }}
            @else - @endif
        </span>
    </div>
    <div class="info-row">
        <span class="info-label">Status</span>
        <span class="info-value"><span class="status-badge s-{{ $status }}">{{ ucwords(str_replace('_',' ',$status)) }}</span></span>
    </div>
</div>

<div class="pwa-card">
    <div class="section-heading"><i class="bi bi-building"></i> Dump Plant</div>
    <div class="info-row"><span class="info-label">Plant name</span><span class="info-value">{{ $ticket->plant?->name ?? '-' }}</span></div>
    <div class="info-row"><span class="info-label">Address</span><span class="info-value">{{ $ticket->plant?->address ?? '-' }}</span></div>
    <div class="info-row"><span class="info-label">Contact</span><span class="info-value">{{ $ticket->plant?->user?->mobile ?? '-' }}</span></div>
    @if ($ticket->plant?->latitude && $ticket->plant?->longitude)
        <a href="https://www.google.com/maps?q={{ $ticket->plant->latitude }},{{ $ticket->plant->longitude }}"
           target="_blank" class="btn-directions">
            <i class="bi bi-geo-alt-fill"></i> Directions to plant
        </a>
    @endif
</div>

{{-- Pickup proof photos — always visible as reference --}}
@php $pickupPhotos = $ticket->photos->where('type','pickup_proof'); @endphp
@if ($pickupPhotos->isNotEmpty())
    <div class="pwa-card">
        <div class="section-heading"><i class="bi bi-images"></i> Pickup Proof Photos</div>
        <div class="photo-preview-grid">
            @foreach ($pickupPhotos as $photo)
                <a href="{{ asset('storage/'.$photo->photo_path) }}" target="_blank">
                    <img src="{{ asset('storage/'.$photo->photo_path) }}" class="photo-thumb">
                </a>
            @endforeach
        </div>
    </div>
@endif

{{-- STEP 1 — Dump form. Visible when: ready_to_dump --}}
@if ($status === 'ready_to_dump')
    <div class="pwa-card">
        <div class="section-heading"><i class="bi bi-box-arrow-in-down-right"></i> Step 1 — Submit Dump Form</div>
        <p style="font-size:13px;color:#666;margin-bottom:14px;">
            Upload photos of the waste being dumped. An OTP will be sent to the plant's WhatsApp on submit.
        </p>
        <form method="POST" action="{{ route('vehicle.dump.submit', $ticket) }}" enctype="multipart/form-data">
            @csrf
            @error('photos')
                <div class="alert alert-danger rounded-3 mb-3" style="font-size:13px;">{{ $message }}</div>
            @enderror
            <label style="font-size:13px;font-weight:600;color:#444;display:block;margin-bottom:6px;">
                Dump photos <span style="color:#e53935">*</span>
            </label>
            <input type="file" name="photos[]" id="dump-photos" accept="image/*" multiple required
                   style="display:none" onchange="previewPhotos(this,'dump-preview')">
            <button type="button" onclick="document.getElementById('dump-photos').click()"
                    class="btn-pwa-primary"
                    style="background:#f0f4fa;color:#2a5780;border:1.5px dashed #2a5780;margin-top:0;">
                <i class="bi bi-camera"></i> Add Photos
            </button>
            <div class="photo-preview-grid" id="dump-preview"></div>
            <label style="font-size:13px;font-weight:600;color:#444;display:block;margin:14px 0 6px;">Remarks (optional)</label>
            <textarea name="remarks" rows="2"
                      style="width:100%;border:1.5px solid #c6d4e8;border-radius:10px;padding:10px;font-size:14px;resize:none;outline:none;"
                      placeholder="Any notes about the dump..."></textarea>
            <button type="submit" class="btn-pwa-success">
                <i class="bi bi-send"></i> Submit &amp; Send OTP to Plant
            </button>
        </form>
    </div>
@endif

{{-- STEP 2 — Dump OTP. Visible when: dump_submitted --}}
@if ($status === 'dump_submitted')
    <div class="pwa-card">
        <div class="section-heading"><i class="bi bi-shield-lock"></i> Step 2 — Enter Plant OTP</div>
        <p style="font-size:13px;color:#666;margin-bottom:14px;">
            Ask the plant operator for the 6-digit OTP sent to their WhatsApp.
            Once verified, the ticket will automatically be marked as <strong>Completed</strong>.
        </p>
        @error('otp')
            <div class="alert alert-danger rounded-3 mb-3" style="font-size:13px;">{{ $message }}</div>
        @enderror
        <form method="POST" action="{{ route('vehicle.dump.otp', $ticket) }}">
            @csrf
            <input type="number" name="otp" class="otp-input"
                   placeholder="••••••" maxlength="6" inputmode="numeric" required>
            <button type="submit" class="btn-pwa-success">
                <i class="bi bi-check-lg"></i> Verify OTP &amp; Complete Ticket
            </button>
        </form>
    </div>

    {{-- Dump proof photos (read only) --}}
    @php $dumpPhotos = $ticket->photos->where('type','dump_proof'); @endphp
    @if ($dumpPhotos->isNotEmpty())
        <div class="pwa-card">
            <div class="section-heading"><i class="bi bi-images"></i> Dump Proof Photos</div>
            <div class="photo-preview-grid">
                @foreach ($dumpPhotos as $photo)
                    <a href="{{ asset('storage/'.$photo->photo_path) }}" target="_blank">
                        <img src="{{ asset('storage/'.$photo->photo_path) }}" class="photo-thumb">
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endif

{{-- Completed state --}}
@if ($status === 'completed')
    <div class="pwa-card text-center" style="border:2px solid #d1e7dd;">
        <i class="bi bi-check-circle-fill text-success" style="font-size:40px;"></i>
        <div style="font-size:16px;font-weight:700;color:#0f5132;margin-top:10px;">Ticket Completed</div>
        <div style="font-size:13px;color:#666;margin-top:4px;">
            {{ $ticket->completed_at?->format('d M Y, h:i A') ?? '-' }}
        </div>
    </div>
@endif

{{-- Status history — always visible --}}
@if ($ticket->statusHistories->isNotEmpty())
    <div class="pwa-card">
        <div class="section-heading"><i class="bi bi-clock-history"></i> Status History</div>
        @foreach ($ticket->statusHistories->sortByDesc('created_at') as $h)
            <div class="info-row">
                <span class="info-label" style="font-size:12px;">
                    {{ ucwords(str_replace('_',' ',$h->status)) }}<br>
                    <span style="color:#aaa;font-weight:400;">{{ $h->created_at?->format('d M, h:i A') }}</span>
                </span>
                <span class="info-value" style="font-size:12px;color:#666;font-weight:400;">{{ $h->remarks ?? '-' }}</span>
            </div>
        @endforeach
    </div>
@endif

</div>
@endsection

@section('script')
<script>
function previewPhotos(input, previewId) {
    var grid = document.getElementById(previewId);
    grid.innerHTML = '';
    Array.from(input.files).forEach(function (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'photo-thumb';
            grid.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endsection