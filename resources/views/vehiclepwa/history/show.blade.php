@extends('vehiclepwa.layout.app')

@section('title') View History @endsection
@section('heading') View History @endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('style')
    <style>
        /* Header */
        .header-card.shape-rounded {
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
            height: 75px !important;
        }

        /* Ticket text */
        .ticket-label {
            font-size: 14px;
            color: #777;
            font-weight: 600;
        }

        .ticket-value {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        /* Carousel Image */
        .carousel-inner img {
            height: 165px;
            object-fit: cover;
        }

        /* Card */
        .tab-card {
            width: 95%;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
        }

        /* Hide radio buttons */
        input[type="radio"] {
            display: none;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border: 1px solid #dcdcdc;
            border-radius: 10px;
            overflow: hidden;
        }

        .tabs label {
            flex: 1;
            padding: 12px;
            text-align: center;
            background: #e5e5e5;
            cursor: pointer;
            border-right: 1px solid #d0d0d0;
        }

        /* Active tab */
        #tab1:checked~.tabs label[for="tab1"],
        #tab2:checked~.tabs label[for="tab2"],
        #tab3:checked~.tabs label[for="tab3"],
        #tab4:checked~.tabs label[for="tab4"] {
            background: #4f7ec3;
            color: white;
        }

        /* Content */
        .content {
            margin-top: 15px;
            color: #555;
            display: none;
        }

        #tab1:checked~#content1,
        #tab2:checked~#content2,
        #tab3:checked~#content3,
        #tab4:checked~#content4 {
            display: block;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card card-style text-center">
            <div class="content1 p-3">

                <!-- Ticket Details -->
                <div class="d-flex row flex-wrap m-0">


                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Ticket ID:</span>
                            <span class="ticket-value">12345</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Applicant Name:</span>
                            <span class="ticket-value">Test</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Mobile Number:</span>
                            <span class="ticket-value">123-456-7890</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Project Type:</span>
                            <span class="ticket-value">Commercial</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Site Address:</span>
                            <span class="ticket-value">787/90</span>
                        </span>
                    </div>

                    <hr>
                    <!-- Time -->
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Total Built Up Area:</span>
                            <span class="ticket-value">1000 sq ft</span>
                        </span>
                    </div>
                    <hr>



                </div>

            </div>
        </div>
        <div class="tab-card">

            <input type="radio" id="tab1" name="tabs" checked>
            <input type="radio" id="tab2" name="tabs">

            <div class="tabs">
                <label for="tab1">Pickup Details</label>
                <label for="tab2">Drop Details</label>
            </div>

            <div id="content1" class="content">
                <!-- Time -->
                <div class="col-12 mb-2">
                    <span class="d-flex flex-row gap-1 fs-14">
                        <span class="ticket-label">Latitude:</span>
                        <span class="ticket-value">22.00</span>
                    </span>
                </div>
                <hr>
                <!-- Time -->
                <div class="col-12 mb-2">
                    <span class="d-flex flex-row gap-1 fs-14">
                        <span class="ticket-label">Longitude:</span>
                        <span class="ticket-value">77.00</span>
                    </span>
                </div>
                <hr>
                <!-- Time -->
                <div class="col-12 mb-2">
                    <span class="d-flex flex-row gap-1 fs-14">
                        <span class="ticket-label">Date & Time:</span>
                        <span class="ticket-value">2025-10-15 10:30 AM</span>
                    </span>
                </div>
                <hr>
                <!-- Photos Carousel -->
                <div class="col-12 mb-3">
                    <div class="ticket-label mb-2 text-start">Photos:</div>
                    <div id="ticketPhotoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3">
                            <div class="carousel-item active">
                                <img src="https://picsum.photos/600/350?1" class="d-block w-100 rounded-3">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/600/350?2" class="d-block w-100 rounded-3">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/600/350?3" class="d-block w-100 rounded-3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#ticketPhotoCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#ticketPhotoCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="content2" class="content">
               <!-- Time -->
                <div class="col-12 mb-2">
                    <span class="d-flex flex-row gap-1 fs-14">
                        <span class="ticket-label">Latitude:</span>
                        <span class="ticket-value">27.00</span>
                    </span>
                </div>
                <hr>
                <!-- Time -->
                <div class="col-12 mb-2">
                    <span class="d-flex flex-row gap-1 fs-14">
                        <span class="ticket-label">Longitude:</span>
                        <span class="ticket-value">78.00</span>
                    </span>
                </div>
                <hr>
                <!-- Time -->
                <div class="col-12 mb-2">
                    <span class="d-flex flex-row gap-1 fs-14">
                        <span class="ticket-label">Date & Time:</span>
                        <span class="ticket-value">2026-10-15 10:30 AM</span>
                    </span>
                </div>
                <hr>
                <!-- Photos Carousel -->
                <div class="col-12 mb-3">
                    <div class="ticket-label mb-2 text-start">Photos:</div>
                    <div id="ticketPhotoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3">
                            <div class="carousel-item active">
                                <img src="https://picsum.photos/600/350?1" class="d-block w-100 rounded-3">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/600/350?2" class="d-block w-100 rounded-3">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/600/350?3" class="d-block w-100 rounded-3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#ticketPhotoCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#ticketPhotoCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                        </button>
                    </div>
                </div>
            </div>



        </div>
    </div>

@endsection

@section('script')

@endsection