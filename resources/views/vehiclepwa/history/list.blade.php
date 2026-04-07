@extends('vehiclepwa.layout.app')

@section('title') History @endsection
@section('heading') History @endsection

@section('style')
    <style>
        /* Header */
        .header-card.shape-rounded {
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
            height: 75px !important;
        }

        .dashboard-container {
            max-width: 520px;
            margin: auto;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 18px;
            padding: 18px 15px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #444;
        }

        .total-number {
            font-size: 25px;
            font-weight: 700;
            /* margin-top:5px; */
        }

        .divider {
            height: 1px;
            background: #cfcfcf;
            margin: 10px 0;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-box {
            flex: 1;
        }

        .stat-box:first-child {
            border-right: 1px solid #cfcfcf;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 600;
        }

        .stat-label {
            font-size: 13px;
            color: #666;
        }

        .pickup {
            color: #2f6fed;
        }

        .dump {
            color: #e53935;
        }

        .completed {
            color: #198754;
        }



        .qr-card {
            display: block;
        }

        .qr-icon-box {
            width: 90px;
            height: 90px;
            margin: auto;
            background: #c6d4e8;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #1f4f8b;
        }

        .qr-text {
            margin-top: 10px;
            font-size: 18px;
            font-weight: 500;
            color: #333;
            line-height: 1.3;
        }

        .w-48 {
            width: 50%;
        }

        .ticket-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            height: 100%;
        }

        .ticket-card:hover {
            transform: translateY(-5px);
        }

        .ticket-icon {
            font-size: 40px;
            color: #e53935;
        }

        .arrow-icon {
            font-size: 22px;
            color: #3f6ed6;
        }

        .ticket-title {
            font-weight: 600;
            font-size: 16px;
            color: #000000bd;
        }

        .ticket-value {
            font-size: 14px;
            color: #666;
        }

        .mt5 {
            margin-top: 55px;
        }
    </style>
@endsection


@section('content')



    <div class="container mt5">
        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-md-4 col-6 mt-1">

                <div class="ticket-card">
                   

                    <div class="mt-1">

                        <div class="ticket-title">Ticket ID</div>
                        <div class="ticket-value">YY788</div>

                    </div>

                    <div class="mt-2">

                        <div class="ticket-title">User Name</div>
                        <div class="ticket-value">Nagarjuna</div>

                    </div>

                    <div class="mt-2">

                        <div class="ticket-title">Quantity</div>
                        <div class="ticket-value">5</div>

                    </div>
                    <div class="mt-2">
                        <div class="d-flex flex-column gap-1 align-items-start justify-content-center">
                            <div class="ticket-title">
                                <a href="{{ route('vehiclehistoryshow') }}" class="btn btn-primary d-flex flex-row p-2"
                                    style="background-color: #2a5780;border-radius: 5px;border-color: #c6d4e8;"><span>View</span> </a>
                            </div>


                        </div>

                    </div>

                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 col-6 mt-1">

                <div class="ticket-card">
                   

                    <div class="mt-1">

                        <div class="ticket-title">Ticket ID</div>
                        <div class="ticket-value">YY789</div>

                    </div>

                    <div class="mt-2">

                        <div class="ticket-title">Owner Name</div>
                        <div class="ticket-value">Rahul</div>

                    </div>

                    <div class="mt-2">

                        <div class="ticket-title">Quantity</div>
                        <div class="ticket-value">3</div>

                    </div>
                    <div class="mt-2">

                       <div class="d-flex flex-column gap-1 align-items-start justify-content-center">
                            <div class="ticket-title">
                                <a href="{{ route('vehiclehistoryshow') }}" class="btn btn-primary d-flex flex-row p-2"
                                    style="background-color: #2a5780;border-radius: 5px;border-color: #c6d4e8;"><span>View</span> </a>
                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>



@endsection


@section('script')
@endsection