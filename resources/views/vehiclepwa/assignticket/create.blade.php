@extends('vehiclepwa.layout.app')

@section('title') Assign Ticket @endsection
@section('heading') Assign Ticket @endsection

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

        .spinner-border-sm {
            margin-right: 5px;
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
                            <span class="ticket-label">Builtup Area:</span>
                            <span class="ticket-value">1000</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Latitude:</span>
                            <span class="ticket-value">22.00</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Longitude:</span>
                            <span class="ticket-value">77.00</span>
                        </span>
                    </div>
                    <hr>
                    <div class="col-12 mb-2">
                        <span class="d-flex flex-row gap-1 fs-14">
                            <span class="ticket-label">Quantity:</span>
                            <span class="ticket-value">10</span>
                        </span>
                    </div>
                    <hr>


                    <form class="needs-validation" novalidate id="myForm">

                        <div class="mb-3">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" required>
                            <div class="invalid-feedback">
                                Please select date
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" required>
                            <div class="invalid-feedback">
                                Please select time
                            </div>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary w-100">
                            <span id="btnText">Submit</span>
                            <span id="btnLoader" class="spinner-border spinner-border-sm d-none"></span>
                        </button>

                    </form>

                </div>

            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        (() => {
            'use strict'

            const form = document.getElementById('myForm')
            const btn = document.getElementById('submitBtn')
            const loader = document.getElementById('btnLoader')
            const btnText = document.getElementById('btnText')

            form.addEventListener('submit', function (event) {

                event.preventDefault()
                event.stopPropagation()

                if (!form.checkValidity()) {

                    form.classList.add('was-validated')
                    return

                }

                btn.disabled = true
                loader.classList.remove('d-none')
                btnText.innerText = "Submitting..."

                setTimeout(function () {

                    loader.classList.add('d-none')
                    btnText.innerText = "Submit"
                    btn.disabled = false

                    Swal.fire({
                        icon: 'success',
                        title: 'Submitted Successfully',
                        text: 'Your form has been submitted',
                        confirmButtonColor: '#3085d6'
                    })

                    form.reset()
                    form.classList.remove('was-validated')

                }, 1500)

            })

        })()
    </script>
@endsection