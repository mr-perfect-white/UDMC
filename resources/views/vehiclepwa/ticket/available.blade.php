@extends('vehiclepwa.layout.app')

@section('title') Available Tickets @endsection
@section('heading') Available Tickets @endsection

@section('style')
<style>
    .mt5 { margin-top: 55px; }

    .ticket-card {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: 0.3s;
    }

    .ticket-title  { font-weight: 600; font-size: 15px; color: #000000bd; }
    .ticket-value  { font-size: 14px; color: #666; }

    .slot-group { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px; }

    .slot-btn {
        flex: 1 1 calc(33% - 8px);
        min-width: 80px;
        padding: 8px 4px;
        border: 1.5px solid #c6d4e8;
        border-radius: 8px;
        background: #f5f8ff;
        font-size: 13px;
        font-weight: 500;
        color: #2a5780;
        text-align: center;
        cursor: pointer;
        transition: background 0.2s, border-color 0.2s;
    }

    .slot-btn:hover,
    .slot-btn.active {
        background: #2a5780;
        border-color: #2a5780;
        color: #fff;
    }

    .date-tab-group { display: flex; gap: 10px; margin-bottom: 12px; }

    .date-tab {
        flex: 1;
        padding: 10px 6px;
        border: 1.5px solid #c6d4e8;
        border-radius: 10px;
        background: #f5f8ff;
        font-size: 13px;
        font-weight: 600;
        color: #2a5780;
        text-align: center;
        cursor: pointer;
        transition: background 0.2s, border-color 0.2s;
    }

    .date-tab:hover,
    .date-tab.active {
        background: #2a5780;
        border-color: #2a5780;
        color: #fff;
    }

    .accept-btn {
        width: 100%;
        padding: 12px;
        background: #198754;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        margin-top: 14px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .accept-btn:hover  { background: #146c43; }
    .accept-btn:disabled { background: #adb5bd; cursor: not-allowed; }

    .badge-raised {
        display: inline-block;
        background: #fff3cd;
        color: #856404;
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .section-label {
        font-size: 12px;
        font-weight: 600;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
        margin-top: 14px;
    }
</style>
@endsection

@section('content')
<div class="container mt5">

    @if (session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <div class="row g-3">
        @forelse ($tickets as $ticket)
            <div class="col-12">
                <div class="ticket-card">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="ticket-title">{{ $ticket->ticket_number }}</span>
                        <span class="badge-raised">Waiting for pickup</span>
                    </div>

                    <div class="row g-2 mb-1">
                        <div class="col-6">
                            <div class="ticket-title">Owner</div>
                            <div class="ticket-value">{{ $ticket->user?->name ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="ticket-title">Quantity</div>
                            <div class="ticket-value">{{ number_format((float) $ticket->estimated_quantity, 2) }} units</div>
                        </div>
                        <div class="col-6">
                            <div class="ticket-title">Ward</div>
                            <div class="ticket-value">{{ $ticket->ward?->name ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="ticket-title">Plant</div>
                            <div class="ticket-value">{{ $ticket->plant?->name ?? '-' }}</div>
                        </div>
                    </div>

                    @if ($ticket->latitude && $ticket->longitude)
                        <a href="https://www.google.com/maps?q={{ $ticket->latitude }},{{ $ticket->longitude }}"
                           target="_blank"
                           class="btn btn-sm d-flex align-items-center gap-1 mt-2"
                           style="background:#2a5780;color:#fff;border-radius:7px;width:fit-content;">
                            <i class="bi bi-geo-alt-fill"></i> View on map
                        </a>
                    @endif

                    {{-- Accept form --}}
                    <form method="POST"
                          action="{{ route('vehicle.tickets.accept', $ticket) }}"
                          class="accept-form mt-3"
                          data-ticket="{{ $ticket->id }}">
                        @csrf

                        {{-- Hidden inputs updated by JS --}}
                        <input type="hidden" name="scheduled_date" class="input-date">
                        <input type="hidden" name="scheduled_time" class="input-time">

                        <div class="section-label">Select pickup date</div>
                        <div class="date-tab-group">
                            <button type="button"
                                    class="date-tab"
                                    data-date="{{ now()->addDay()->toDateString() }}">
                                Tomorrow<br>
                                <span style="font-weight:400;font-size:12px;">
                                    {{ now()->addDay()->format('D, d M') }}
                                </span>
                            </button>
                            <button type="button"
                                    class="date-tab"
                                    data-date="{{ now()->addDays(2)->toDateString() }}">
                                Day after<br>
                                <span style="font-weight:400;font-size:12px;">
                                    {{ now()->addDays(2)->format('D, d M') }}
                                </span>
                            </button>
                        </div>

                        <div class="section-label">Select time slot</div>
                        <div class="slot-group">
                            @foreach (['08:00' => '8:00 AM', '10:00' => '10:00 AM', '12:00' => '12:00 PM', '14:00' => '2:00 PM', '16:00' => '4:00 PM'] as $value => $label)
                                <button type="button" class="slot-btn" data-time="{{ $value }}">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        <button type="submit" class="accept-btn" disabled>
                            Accept &amp; Schedule
                        </button>
                    </form>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="ticket-card text-center py-4">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <div class="ticket-title mt-2">No available tickets right now.</div>
                    <div class="ticket-value">Check back later.</div>
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
<script>
document.querySelectorAll('.accept-form').forEach(function (form) {
    var inputDate = form.querySelector('.input-date');
    var inputTime = form.querySelector('.input-time');
    var submitBtn = form.querySelector('.accept-btn');

    function updateSubmit() {
        submitBtn.disabled = !(inputDate.value && inputTime.value);
    }

    form.querySelectorAll('.date-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            form.querySelectorAll('.date-tab').forEach(function (t) { t.classList.remove('active'); });
            tab.classList.add('active');
            inputDate.value = tab.dataset.date;
            updateSubmit();
        });
    });

    form.querySelectorAll('.slot-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            form.querySelectorAll('.slot-btn').forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            inputTime.value = btn.dataset.time;
            updateSubmit();
        });
    });

    form.addEventListener('submit', function (e) {
        if (!inputDate.value || !inputTime.value) {
            e.preventDefault();
            alert('Please select both a date and a time slot.');
        }
    });
});
</script>
@endsection