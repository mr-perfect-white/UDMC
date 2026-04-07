<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>Vehicle Registration - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/styles/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/pwa/fonts/css/fontawesome-all.min.css') }}">
    <link rel="manifest" href="{{ asset('frontend/pwa/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/pwa/app/icons/icon-192x192.png') }}">
    <style>
        .bg-highlight { background-color: #1f4e79 !important; }
        .spinner-border-sm { width: 1rem; height: 1rem; }
        .custom-label {
            font-size: 14px; font-weight: 600;
            color: #2a5780; letter-spacing: 1px;
        }
        .custom-input {
            background: #f2f2f2; border: none; border-radius: 10px;
            padding: 14px 18px; font-size: 15px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
        }
        .custom-input:focus {
            background: #f2f2f2;
            box-shadow: 0 0 0 2px rgba(63,185,92,0.25);
        }
        .form-control::placeholder { color: #8f8f8f; }

        .img-status {
            display: none !important;
        }
        .img-preview {
            display: none !important;
        }
        #pageLoader {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(31, 78, 121, 0.92);
            z-index: 99999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 14px;
        }
        #pageLoader.active { display: flex; }
        #pageLoader .spin {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255,255,255,0.25);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        #pageLoader p { color: #fff; margin: 0; font-size: 15px; font-weight: 600; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .select2-container--default .select2-selection--single {
            height: 52px;
            border: none;
            border-radius: 10px;
            background: #f2f2f2;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
            padding-top: 10px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 52px;
        }
        .select2-container {
            width: 100% !important;
            max-width: 100%;
        }
        .select2-selection__rendered {
            white-space: normal !important;
            line-height: 1.3 !important;
            padding-right: 28px !important;
            word-break: break-word;
        }
        .select2-results__option {
            white-space: normal !important;
            word-break: break-word;
        }
        .header-brand {
            position: absolute;
            z-index: 10;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body class="theme-light" data-highlight="blue2">



<div id="page">
    <div class="page-content">
        <div class="page-title page-title-large"></div>

        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ asset('frontend/pwa/images/bbmp.png') }}"></div>
            <div class="header-brand">
                <h2 class="text-white mt-1">UDMS</h2>
            </div>
        </div>


        <div class="card card-style mt-5">
            <div class="content">
                <div class="col-12 ps-0">
                    <div class="text-center" style="position:relative;">
                        <img src="{{ asset('frontend/pwa/images/bbmplogo.png') }}" width="75" height="75" class="rounded-xl">
                    </div>
                </div>
            </div>

            <div class="content mt-2 mb-3">
                <h2 class="mb-3 color-dark">Registration</h2>
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif
                <form class="needs-validation" novalidate id="vehicleForm" method="POST"
                    action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="driver_same_as_owner" id="driverSameAsOwnerInput" value="{{ old('driver_same_as_owner') ? 1 : 0 }}">

                    {{-- ══ Vehicle Details ══ --}}
                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Ward <span class="text-danger">*</span></label>
                        <select name="ward_id" id="wardId"
                            class="form-select custom-input @error('ward_id') is-invalid @enderror" required>
                            <option value="" disabled {{ old('ward_id') ? '' : 'selected' }}>Select Ward</option>
                            @foreach($wards as $ward)
                <option value="{{ $ward->id }}" {{ old('ward_id') == $ward->id ? 'selected' : '' }}>
                    Ward {{ $ward->number }} - {{ $ward->name }}
                </option>
            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select the ward for this vehicle.</div>
                        @error('ward_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Vehicle Number <span class="text-danger">*</span></label>
                        <input type="text" name="vehicle_number"
                            class="form-control custom-input @error('vehicle_number') is-invalid @enderror"
                            placeholder="Enter vehicle number (KA01AB1234)"
                            value="{{ old('vehicle_number') }}"
                            oninput="this.value=this.value.toUpperCase();" required>
                        <div class="invalid-feedback">Please enter a valid Indian vehicle number.</div>
                        @error('vehicle_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Vehicle Photo <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('vehicle_photo') is-invalid @enderror"
                            type="file" name="vehicle_photo" accept="image/*" capture="environment" data-compress required>
                        <img class="img-preview" id="prev_vehicle_photo">
                        <div class="img-status d-none" id="stat_vehicle_photo"></div>
                        <div class="invalid-feedback">Please upload a valid vehicle photo.</div>
                        @error('vehicle_photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                      <div class="mb-3">
    <label class="form-label custom-label mb-0 ms-1">
        Vehicle Type <span class="text-danger">*</span>
    </label>

    <select name="vehicle_type" id="vehicleType"
        class="form-select custom-input @error('vehicle_type') is-invalid @enderror" required>

        <option value="" disabled {{ old('vehicle_type') ? '' : 'selected' }}>
            Select Vehicle Type
        </option>

        <option value="Lorry" {{ old('vehicle_type') == 'Lorry' ? 'selected' : '' }}>Lorry</option>
        <option value="Truck" {{ old('vehicle_type') == 'Truck' ? 'selected' : '' }}>Truck</option>
        <option value="Tripper" {{ old('vehicle_type') == 'Tripper' ? 'selected' : '' }}>Tripper</option>
        <option value="Mini Truck" {{ old('vehicle_type') == 'Mini Truck' ? 'selected' : '' }}>Mini Truck</option>

    </select>

    <div class="invalid-feedback">Please select a vehicle type.</div>

    @error('vehicle_type')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Capacity of Vehicle <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('capacity') is-invalid @enderror"
                            type="text" name="capacity" placeholder="Enter capacity, e.g. 3 Tons"
                            value="{{ old('capacity') }}" required>
                        <div class="invalid-feedback">Please enter a vehicle capacity.</div>
                        @error('capacity')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">RC Photo/PDF <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('rc_document') is-invalid @enderror"
                            type="file" name="rc_document" accept="image/*,application/pdf" required>
                        <div class="invalid-feedback">Please upload a valid RC photo/pdf.</div>
                        @error('rc_document')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Fitness Certificate <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('fitness_certificate') is-invalid @enderror"
                            type="file" name="fitness_certificate" accept="image/*,application/pdf" required>
                        <div class="invalid-feedback">Please upload a valid fitness certificate.</div>
                        @error('fitness_certificate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <hr>

                    {{-- ══ Owner Details ══ --}}
                    <h4>Vehicle Owner Details</h4>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Name <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_name') is-invalid @enderror"
                            placeholder="Enter owner's name" type="text" id="ownerName" name="owner_name"
                            value="{{ old('owner_name') }}" required>
                        <div class="invalid-feedback">Please enter the owner's name.</div>
                        @error('owner_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Phone <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_mobile') is-invalid @enderror"
                            placeholder="Enter owner's phone number" type="text" id="ownerPhone" name="owner_mobile"
                            value="{{ old('owner_mobile') }}" maxlength="10"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                        <div class="invalid-feedback">Please enter the owner's phone number.</div>
                        @error('owner_mobile')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Email <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_email') is-invalid @enderror"
                            placeholder="Enter owner's email" type="email" name="owner_email"
                            value="{{ old('owner_email') }}" required>
                        <div class="invalid-feedback">Please enter the owner's email.</div>
                        @error('owner_email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Address <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_address') is-invalid @enderror"
                            placeholder="Enter owner's address" type="text" id="ownerAddress" name="owner_address"
                            value="{{ old('owner_address') }}" required>
                        <div class="invalid-feedback">Please enter the owner's address.</div>
                        @error('owner_address')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Photo <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_photo') is-invalid @enderror"
                            type="file" name="owner_photo" accept="image/*" capture="environment" data-compress required>
                        <img class="img-preview" id="prev_owner_photo">
                        <div class="img-status d-none" id="stat_owner_photo"></div>
                        <div class="invalid-feedback">Please upload a valid photo.</div>
                        @error('owner_photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Aadhaar Number <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_aadhaar_number') is-invalid @enderror"
                            type="text" id="ownerAadhaarNumber" name="owner_aadhaar_number"
                            placeholder="Enter Aadhaar number" maxlength="12"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                            value="{{ old('owner_aadhaar_number') }}" required>
                        <div class="invalid-feedback">Please enter a valid 12-digit Aadhaar number.</div>
                        @error('owner_aadhaar_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Aadhaar Photo <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('owner_aadhaar_photo') is-invalid @enderror"
                            type="file" name="owner_aadhaar_photo" accept="image/*" capture="environment" data-compress required>
                        <img class="img-preview" id="prev_owner_aadhaar_photo">
                        <div class="img-status d-none" id="stat_owner_aadhaar_photo"></div>
                        <div class="invalid-feedback">Please upload a valid Aadhaar photo.</div>
                        @error('owner_aadhaar_photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Password <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('password') is-invalid @enderror"
                            placeholder="Enter password" type="password" name="password" required>
                        <div class="invalid-feedback">Please enter password.</div>
                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <hr>

                    {{-- ══ Driver Details ══ --}}
                    <h4>Driver Details</h4>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="driverSameAsOwner" {{ old('driver_same_as_owner') ? 'checked' : '' }}>
                        <label class="form-check-label" for="driverSameAsOwner">Same as Owner</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Name <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_name') is-invalid @enderror"
                            placeholder="Enter driver's name" type="text" id="driverName" name="driver_name"
                            value="{{ old('driver_name') }}" required>
                        <div class="invalid-feedback">Please enter the driver's name.</div>
                        @error('driver_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Phone <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_mobile') is-invalid @enderror"
                            placeholder="Enter driver's phone number" type="text" id="driverPhone" name="driver_mobile"
                            value="{{ old('driver_mobile') }}" maxlength="10"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                        <div class="invalid-feedback">Please enter the driver's phone number.</div>
                        @error('driver_mobile')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Address <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_address') is-invalid @enderror"
                            placeholder="Enter driver's address" type="text" id="driverAddress" name="driver_address"
                            value="{{ old('driver_address') }}" required>
                        <div class="invalid-feedback">Please enter the driver's address.</div>
                        @error('driver_address')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">License Number <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_license_number') is-invalid @enderror"
                            placeholder="Enter driver's license number" type="text" id="driverLicense" name="driver_license_number"
                            value="{{ old('driver_license_number') }}" required>
                        <div class="invalid-feedback">Please enter the driver's license number.</div>
                        @error('driver_license_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">License Photo <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_license_photo') is-invalid @enderror"
                            type="file" name="driver_license_photo" accept="image/*" capture="environment" data-compress required>
                        <img class="img-preview" id="prev_driver_license_photo">
                        <div class="img-status d-none" id="stat_driver_license_photo"></div>
                        <div class="invalid-feedback">Please upload a valid license photo.</div>
                        @error('driver_license_photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Aadhaar Number <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_aadhaar_number') is-invalid @enderror"
                            placeholder="Enter driver's aadhaar number" type="text" id="driverAadhaarNumber" name="driver_aadhaar_number"
                            value="{{ old('driver_aadhaar_number') }}" maxlength="12"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                        <div class="invalid-feedback">Please enter the driver's aadhaar number.</div>
                        @error('driver_aadhaar_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label custom-label mb-0 ms-1">Aadhaar Photo <span class="text-danger">*</span></label>
                        <input class="form-control custom-input @error('driver_aadhaar_photo') is-invalid @enderror"
                            type="file" name="driver_aadhaar_photo" accept="image/*" capture="environment" data-compress required>
                        <img class="img-preview" id="prev_driver_aadhaar_photo">
                        <div class="img-status d-none" id="stat_driver_aadhaar_photo"></div>
                        <div class="invalid-feedback">Please upload a valid Aadhaar photo.</div>
                        @error('driver_aadhaar_photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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

        
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('frontend/pwa/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/pwa/scripts/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.2/dist/browser-image-compression.js"></script>

<script>
// ── Image compression config ─────────────────────────────────────────────────
const COMPRESS_OPTIONS = {
    maxSizeMB: 0.4,          // target ≤ 400 KB per image
    maxWidthOrHeight: 1280,  // shrink large photos
    useWebWorker: true,      // non-blocking
    fileType: 'image/jpeg',
    initialQuality: 0.8,
};

/**
 * Compress one image input as soon as a file is picked.
 * Replaces the input's FileList with the compressed Blob via DataTransfer.
 */
async function compressInput(input) {
    const file = input.files[0];
    if (!file) return;

    const name   = input.name;
    const statEl = document.getElementById('stat_' + name);
    const prevEl = document.getElementById('prev_' + name);

    // Show "compressing" badge
    statEl.className = 'img-status compressing';
    statEl.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Compressing…';
    statEl.classList.remove('d-none');

    try {
        const originalKB   = (file.size / 1024).toFixed(0);
        const compressed   = await imageCompression(file, COMPRESS_OPTIONS);
        const compressedKB = (compressed.size / 1024).toFixed(0);

        // Replace the FileList with the compressed file
        const dt = new DataTransfer();
        dt.items.add(new File([compressed], file.name, { type: compressed.type }));
        input.files = dt.files;

        // Show thumbnail preview
        if (prevEl) {
            prevEl.src = URL.createObjectURL(compressed);
            prevEl.style.display = 'block';
        }

        statEl.className = 'img-status done';
        statEl.innerHTML = `✓ ${originalKB} KB → ${compressedKB} KB`;
    } catch (err) {
        statEl.className = 'img-status error';
        statEl.innerHTML = '⚠ Compression failed — original file will be used';
        console.warn('Image compression error:', err);
    }
}

// Attach compression to every [data-compress] input
document.querySelectorAll('input[type="file"][data-compress]').forEach(input => {
    input.addEventListener('change', () => compressInput(input));
});

// ── Form validation & submit ─────────────────────────────────────────────────
(() => {
    const form   = document.getElementById('vehicleForm');
    const btn    = document.getElementById('submitBtn');
    const loader = document.getElementById('btnLoader');
    const text   = document.getElementById('btnText');

    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }
        loader.classList.remove('d-none');
        text.innerHTML = 'Processing…';
        btn.disabled   = true;
        document.getElementById('pageLoader').classList.add('active');
    });

    @if($errors->any())
        form.classList.add('was-validated');
    @endif
})();

// ── Driver same as owner ─────────────────────────────────────────────────────
const sameAsOwnerCheckbox = document.getElementById('driverSameAsOwner');
const sameAsOwnerInput = document.getElementById('driverSameAsOwnerInput');
const sameAsOwnerFields = [
    ['ownerName', 'driverName'],
    ['ownerPhone', 'driverPhone'],
    ['ownerAddress', 'driverAddress'],
    ['ownerAadhaarNumber', 'driverAadhaarNumber'],
];

function syncDriverFromOwner() {
    const checked = sameAsOwnerCheckbox.checked;
    sameAsOwnerInput.value = checked ? '1' : '0';

    sameAsOwnerFields.forEach(([src, dst]) => {
        const srcEl = document.getElementById(src);
        const dstEl = document.getElementById(dst);

        if (checked) {
            dstEl.value = srcEl.value;
            dstEl.setAttribute('readonly', true);
        } else {
            dstEl.removeAttribute('readonly');
        }
    });
}

sameAsOwnerCheckbox.addEventListener('change', syncDriverFromOwner);

sameAsOwnerFields.forEach(([src]) => {
    document.getElementById(src).addEventListener('input', function () {
        if (sameAsOwnerCheckbox.checked) {
            syncDriverFromOwner();
        }
    });
});

if (sameAsOwnerCheckbox.checked) {
    syncDriverFromOwner();
}

$(document).ready(function () {
    $('#wardId').select2({
        placeholder: 'Search and select ward',
        width: '100%'
    });

    $('#vehicleType').select2({
        placeholder: 'Select vehicle type',
        width: '100%',
        minimumResultsForSearch: Infinity
    });
});
</script>



</body>
</html>