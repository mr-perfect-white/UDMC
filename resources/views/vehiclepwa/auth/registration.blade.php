<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>Vehicle Registration - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/style.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/fonts/css/fontawesome-all.min.css') }}">
    <link rel="manifest" href="{{ asset('frontend/pwa/_manifest.json') }}"
        data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/pwa/app/icons/icon-192x192.png') }}">
    <style>
        .new-family {
            font-family: 'Anek Kannada', sans-serif !important;
        }

        .bg-highlight {
            background-color: #1f4e79 !important;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        .custom-label {
            font-size: 14px;
            font-weight: 600;
            color: #2a5780;
            letter-spacing: 1px;
        }

        .custom-input {
            background: #f2f2f2;
            border: none;
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 15px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .custom-input:focus {
            background: #f2f2f2;
            box-shadow: 0 0 0 2px rgba(63, 185, 92, 0.25);
        }

        .form-control::placeholder {
            color: #8f8f8f;
        }

        .mt2 {
            margin-top: 5px;
        }
    </style>
</head>

<body class="theme-light" data-highlight="blue2">

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">

        <div class="page-content">
            <div class="page-title page-title-large"></div>

            <div class="card header-card shape-rounded" data-card-height="210">
                <div class="card-overlay bg-highlight opacity-95"></div>
                <div class="card-overlay dark-mode-tint"></div>
                <div class="card-bg preload-img" data-src="{{ asset('frontend/pwa/images/bbmp.png') }}"></div>
                <div class="position-absolute" style="z-index: 10;right: 40%;top: 10px;">
                    <h2 class="text-white mt-1">CDWMS</h2>
                </div>
            </div>

            @if (Session::has('success'))
                <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert"
                        aria-label="Close">&times;</button>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
                    <span><i class="fa fa-times"></i></span>
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert"
                        aria-label="Close">&times;</button>
                </div>
            @endif

            <div class="card card-style mt-5">
                <div class="content">
                    <div class="col-12 ps-0">
                        <div class="text-center" style="position:relative;">
                            <img src="{{ asset('frontend/pwa/images/bbmplogo.png') }}" width="75" height="75"
                                class="rounded-xl ">
                        </div>
                    </div>
                </div>

                <div class="content mt-2 mb-3">
                    <h2 class="mb-3 color-dark">{{ __('messages.registration') }}</h2>

                    <form class="needs-validation" novalidate id="vehicleForm" method="POST"
                        action="{{ route('vehicleregistration.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Vehicle Number <span class="text-danger">*</span></label>
                            <input type="text" name="vehicle_number" class="form-control custom-input @error('vehicle_number') is-invalid @enderror"
                                placeholder="Enter vehicle number (KA01AB1234)"
                                value="{{ old('vehicle_number') }}"
                                oninput="this.value=this.value.toUpperCase();"
                                required>
                            <div class="invalid-feedback">Please enter a valid Indian vehicle number.</div>
                            @error('vehicle_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Vehicle Photo <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('vehicle_photo') is-invalid @enderror" type="file" name="vehicle_photo" required>
                            <div class="invalid-feedback">Please upload a valid vehicle photo.</div>
                            @error('vehicle_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Vehicle Type <span class="text-danger">*</span></label>
                            <select name="vehicle_type" class="form-select custom-input @error('vehicle_type') is-invalid @enderror" required>
                                <option value="" disabled {{ old('vehicle_type') ? '' : 'selected' }}>Select Vehicle Type</option>
                                <option value="car" {{ old('vehicle_type') === 'car' ? 'selected' : '' }}>Car</option>
                                <option value="bike" {{ old('vehicle_type') === 'bike' ? 'selected' : '' }}>Bike</option>
                                <option value="truck" {{ old('vehicle_type') === 'truck' ? 'selected' : '' }}>Truck</option>
                            </select>
                            <div class="invalid-feedback">Please select a vehicle type.</div>
                            @error('vehicle_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Capacity of Vehicle <span class="text-danger">*</span></label>
                            <select name="capacity" class="form-select custom-input @error('capacity') is-invalid @enderror" required>
                                <option value="" disabled {{ old('capacity') ? '' : 'selected' }}>Select Capacity</option>
                                <option value="1 Tons" {{ old('capacity') === '1 Tons' ? 'selected' : '' }}>1 Tons</option>
                                <option value="2 Tons" {{ old('capacity') === '2 Tons' ? 'selected' : '' }}>2 Tons</option>
                                <option value="3 Tons" {{ old('capacity') === '3 Tons' ? 'selected' : '' }}>3 Tons</option>
                                <option value="4 Tons" {{ old('capacity') === '4 Tons' ? 'selected' : '' }}>4 Tons</option>
                                <option value="5 Tons" {{ old('capacity') === '5 Tons' ? 'selected' : '' }}>5 Tons</option>
                            </select>
                            <div class="invalid-feedback">Please select a vehicle capacity.</div>
                            @error('capacity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">RC Photo/PDF <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('rc_document') is-invalid @enderror" type="file" name="rc_document" required>
                            <div class="invalid-feedback">Please upload a valid RC photo/pdf.</div>
                            @error('rc_document')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Fitness Certificate <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('fitness_certificate') is-invalid @enderror" type="file" name="fitness_certificate" required>
                            <div class="invalid-feedback">Please upload a valid fitness certificate.</div>
                            @error('fitness_certificate')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <h4>Vehicle Owner Details</h4>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_name') is-invalid @enderror"
                                placeholder="Enter owner's name" type="text" id="ownerName" name="owner_name"
                                value="{{ old('owner_name') }}" required>
                            <div class="invalid-feedback">Please enter the owner's name.</div>
                            @error('owner_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Phone <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_mobile') is-invalid @enderror"
                                placeholder="Enter owner's phone number" type="text" id="ownerPhone" name="owner_mobile"
                                value="{{ old('owner_mobile') }}" required>
                            <div class="invalid-feedback">Please enter the owner's phone number.</div>
                            @error('owner_mobile')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Email <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_email') is-invalid @enderror"
                                placeholder="Enter owner's email" type="email" name="owner_email"
                                value="{{ old('owner_email') }}" required>
                            <div class="invalid-feedback">Please enter the owner's email.</div>
                            @error('owner_email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Address <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_address') is-invalid @enderror"
                                placeholder="Enter owner's address" type="text" id="ownerAddress" name="owner_address"
                                value="{{ old('owner_address') }}" required>
                            <div class="invalid-feedback">Please enter the owner's address.</div>
                            @error('owner_address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Photo <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_photo') is-invalid @enderror" type="file" name="owner_photo" required>
                            <div class="invalid-feedback">Please upload a valid photo.</div>
                            @error('owner_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Aadhaar Number <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_aadhaar_number') is-invalid @enderror"
                                type="text" name="owner_aadhaar_number"
                                placeholder="Enter Aadhaar number" pattern="\d{12}" maxlength="12"
                                value="{{ old('owner_aadhaar_number') }}" required>
                            <div class="invalid-feedback">Please enter a valid 12-digit Aadhaar number.</div>
                            @error('owner_aadhaar_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Aadhaar Photo <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('owner_aadhaar_photo') is-invalid @enderror" type="file" name="owner_aadhaar_photo" required>
                            <div class="invalid-feedback">Please upload a valid Aadhaar photo.</div>
                            @error('owner_aadhaar_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Password <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('password') is-invalid @enderror"
                                placeholder="Enter password" type="password" name="password" required>
                            <div class="invalid-feedback">Please enter password.</div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <h4>Driver Details</h4>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="driverSameAsOwner">
                            <label class="form-check-label" for="driverSameAsOwner">
                                Same as Owner
                            </label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_name') is-invalid @enderror"
                                placeholder="Enter driver's name" type="text" id="driverName" name="driver_name"
                                value="{{ old('driver_name') }}" required>
                            <div class="invalid-feedback">Please enter the driver's name.</div>
                            @error('driver_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Phone <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_mobile') is-invalid @enderror"
                                placeholder="Enter driver's phone number" type="text" id="driverPhone" name="driver_mobile"
                                value="{{ old('driver_mobile') }}" required>
                            <div class="invalid-feedback">Please enter the driver's phone number.</div>
                            @error('driver_mobile')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Address <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_address') is-invalid @enderror"
                                placeholder="Enter driver's address" type="text" id="driverAddress" name="driver_address"
                                value="{{ old('driver_address') }}" required>
                            <div class="invalid-feedback">Please enter the driver's address.</div>
                            @error('driver_address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">License Number <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_license_number') is-invalid @enderror"
                                placeholder="Enter driver's license number" type="text" id="driverLicense" name="driver_license_number"
                                value="{{ old('driver_license_number') }}" required>
                            <div class="invalid-feedback">Please enter the driver's license number.</div>
                            @error('driver_license_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">License Photo <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_license_photo') is-invalid @enderror" type="file" name="driver_license_photo" required>
                            <div class="invalid-feedback">Please upload a valid license photo.</div>
                            @error('driver_license_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Aadhaar Number <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_aadhaar_number') is-invalid @enderror"
                                placeholder="Enter driver's aadhaar number" type="text" name="driver_aadhaar_number"
                                value="{{ old('driver_aadhaar_number') }}" required>
                            <div class="invalid-feedback">Please enter the driver's aadhaar number.</div>
                            @error('driver_aadhaar_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label custom-label mb-0 ms-1">Aadhaar Photo <span class="text-danger">*</span></label>
                            <input class="form-control custom-input @error('driver_aadhaar_photo') is-invalid @enderror" type="file" name="driver_aadhaar_photo" required>
                            <div class="invalid-feedback">Please upload a valid Aadhaar photo.</div>
                            @error('driver_aadhaar_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <button type="submit" id="submitBtn" class="btn btn-primary w-50"
                                style="background-color:#2a5780 !important;border-color:#2a5780;border-radius:8px">
                                <span id="btnText">Register</span>
                                <span id="btnLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="footer" data-menu-load="{{ route('pwa-footer') }}"></div>
        </div>
    </div>

    <div class="position-fixed" style="top: 11px; right: 3px;">
        <select class="form-control p-0 px-2 m-0" style="border-radius: 8px;"
            onchange="window.location.href = '{{ url('/local') }}/' + this.value;">
            <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>KN</option>
            <option value="kn" {{ App::getLocale() == 'kn' ? 'selected' : '' }}>EN</option>
        </select>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/pwa/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/pwa/scripts/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (() => {
            'use strict';

            const form = document.getElementById('vehicleForm');
            const btn = document.getElementById('submitBtn');
            const loader = document.getElementById('btnLoader');
            const text = document.getElementById('btnText');

            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                loader.classList.remove('d-none');
                text.innerHTML = "Processing...";
                btn.disabled = true;
            });

            @if ($errors->any())
                form.classList.add('was-validated');
            @endif
        })();
    </script>

    <script>
        document.getElementById('driverSameAsOwner').addEventListener('change', function() {
            const isChecked = this.checked;

            const ownerName = document.getElementById('ownerName').value;
            const ownerPhone = document.getElementById('ownerPhone').value;
            const ownerAddress = document.getElementById('ownerAddress').value;

            const driverName = document.getElementById('driverName');
            const driverPhone = document.getElementById('driverPhone');
            const driverAddress = document.getElementById('driverAddress');

            if (isChecked) {
                driverName.value = ownerName;
                driverPhone.value = ownerPhone;
                driverAddress.value = ownerAddress;

                driverName.setAttribute('readonly', true);
                driverPhone.setAttribute('readonly', true);
                driverAddress.setAttribute('readonly', true);
            } else {
                driverName.value = '';
                driverPhone.value = '';
                driverAddress.value = '';

                driverName.removeAttribute('readonly');
                driverPhone.removeAttribute('readonly');
                driverAddress.removeAttribute('readonly');
            }
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                confirmButtonColor: '#2a5780'
            });
        </script>
    @endif

</body>
</html>
