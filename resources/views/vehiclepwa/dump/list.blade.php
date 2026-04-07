@extends('vehiclepwa.layout.app')

@section('title') Dump List @endsection
@section('heading') Dump List @endsection

@section('style')
<style>
    .mt5 { margin-top: 55px; }

    .ticket-card {
        background: #fff;
        border-radius: 15px;
        padding: 18px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        height: 100%;
    }

    .ticket-title { font-weight: 600; font-size: 15px; color: #000000bd; }
    .ticket-value { font-size: 14px; color: #666; }

    .badge-dump {
        display: inline-block;
        background: #e2d9f3;
        color: #4b2e83;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-submitted {
        display: inline-block;
        background: #fff3cd;
        color: #664d03;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="container mt5">

    <div class="row g-3">
        @forelse ($tickets as $ticket)
            <div class="col-6 col-md-4">
                <div class="ticket-card">

                    <div class="mb-2">
                        @if ($ticket->status === 'dump_submitted')
                            <span class="badge-submitted">OTP pending</span>
                        @else
                            <span class="badge-dump">Ready to dump</span>
                        @endif
                    </div>

                    <div class="mt-1">
                        <div class="ticket-title">Ticket ID</div>
                        <div class="ticket-value">{{ $ticket->ticket_number }}</div>
                    </div>

                    <div class="mt-2">
                        <div class="ticket-title">Owner</div>
                        <div class="ticket-value">{{ $ticket->user?->name ?? '-' }}</div>
                    </div>

                    <div class="mt-2">
                        <div class="ticket-title">Quantity</div>
                        <div class="ticket-value">{{ number_format((float) $ticket->estimated_quantity, 2) }}</div>
                    </div>

                    <div class="mt-2">
                        <div class="ticket-title">Scheduled</div>
                        <div class="ticket-value">
                            @if ($ticket->scheduled_date)
                                {{ \Carbon\Carbon::parse($ticket->scheduled_date)->format('d M Y') }}
                                {{ $ticket->scheduled_time ? '· ' . \Carbon\Carbon::parse($ticket->scheduled_time)->format('h:i A') : '' }}
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="ticket-title">Plant</div>
                        <div class="ticket-value">{{ $ticket->plant?->name ?? '-' }}</div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('vehicle.dump.show', $ticket) }}"
                           class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-1"
                           style="background:#2a5780;border-color:#2a5780;border-radius:8px;font-size:14px;font-weight:600;">
                            <i class="bi bi-box-arrow-in-down-right"></i> Dump
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="ticket-card text-center py-4">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <div class="ticket-title mt-2">No tickets ready to dump.</div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>

</div>
@endsection

@section('script')
@endsection