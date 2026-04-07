@extends('frontend.layouts.app')

<style>
body {
    font-family: 'Roboto', system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
}

.form-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.section-title {
    font-weight: 600;
    color: #1d3557;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    padding-bottom: 0 !important;
}

.section-number {
    width: 28px;
    height: 28px;
    background: #1f4e79;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background: #1f4e79 !important;
    border: none !important;
}

.btn-primary:hover {
    background: #1a3f66 !important;
}

.form-label {
    margin-bottom: 0 !important;
}
.form-label {
    margin-bottom: .5rem;
    color: #fff;
}

.form-text {
    font-size: 12px;
}

table {
    caption-side: bottom;
    border-collapse: collapse;
    width: 100%;
    color: #fff;
   border-color: #1f4e79;
}
h4 {
    text-align: center;
    color: #fff !important;
}
</style>

@section('content')
<main class="main">
    <div class="container py-5">
        <div class="col-lg-8 mx-auto">
            <div class="card form-card p-4">
                <div class="card-header mb-4" style="background:#1f4e79;">
                    <h4 class="text-center text-white mt-2">
                        Status Page
                    </h4>

                    <form action="{{ route('status') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Enter Register ID <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                 
                                    placeholder="Enter your register id"
                                    value="{{ old('name') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter your register id</div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                            <span class="btn-text">
                                Check the Status <i class="bi bi-arrow-right"></i>
                            </span>
                            <span class="loader spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>


                        
                    </form>

                    @if($applicationId)
    <h4>Application ID: {{ $applicationId }}</h4>
@endif

@if($register)

    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <td>{{ $register->name }}</td>
        </tr>

        <tr>
            <th>Mobile</th>
            <td>{{ $register->mobile }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $register->email }}</td>
        </tr>

        <tr>
            <th>Property Type</th>
            <td>{{ $register->property_type }}</td>
        </tr>

        <tr>
            <th>Site Address</th>
            <td>{{ $register->site_address }}</td>
        </tr>

        <tr>
            <th>Ward</th>
            <td>{{ $register->ward_id }}</td>
        </tr>

        <tr>
            <th>Built Up Area</th>
            <td>{{ $register->built_up_area }}</td>
        </tr>

        <tr>
            <th>Estimated Waste</th>
            <td>{{ $register->estimated_waste }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                @if($register->status == 'pending')
                    <span style="color: orange;">Pending</span>
                @elseif($register->status == 'approved')
                    <span style="color: green;">Approved</span>
                @else
                    {{ $register->status }}
                @endif
            </td>
        </tr>

        {{-- ✅ Show QR if available --}}
        @if($register->qr_code)
        <tr>
            <th>QR Code</th>
            <td>
                <img src="{{ asset($register->qr_code) }}" width="150">
            </td>
        </tr>
        @endif

        {{-- ✅ Show PDF if available --}}
        @if($register->pdf_file)
        <tr>
            <th>Download PDF</th>
            <td>
                <a href="{{ asset($register->pdf_file) }}" target="_blank">Download</a>
            </td>
        </tr>
        @endif

    </table>

@elseif($applicationId)

    <p style="color:#fffa73; text-align:center;">Pending for this Application ID</p>

@endif
                </div>

                
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Application Submitted Successfully',
        text: @json(session('success')),
        confirmButtonColor: '#1f4e79'
    });
</script>
@endif

<script>
const projectRadios = document.querySelectorAll('.projectType');
const demolitionTypeWrapper = document.getElementById('demolitionTypeWrapper');
const demolitionType = document.getElementById('demolitionType');
const builtUpAreaInput = document.getElementById('builtUpArea');
const estimatedWasteInput = document.getElementById('estimatedWaste');
const wasteHelpText = document.getElementById('wasteHelpText');
const processingCharges = document.getElementById('processingCharges');
const transportationCharges = document.getElementById('transportationCharges');
const administrativeCharges = document.getElementById('administrativeCharges');
const estimatedAmount = document.getElementById('estimatedAmount');
const detectLocationBtn = document.getElementById('detectLocationBtn');
const latitudeInput = document.getElementById('latitude');
const longitudeInput = document.getElementById('longitude');
const locationStatus = document.getElementById('locationStatus');
const form = document.getElementById('applicationForm');
const button = document.getElementById('submitBtn');
const loader = button.querySelector('.loader');
const text = button.querySelector('.btn-text');

function getSelectedPropertyType() {
    const selected = document.querySelector('.projectType:checked');
    return selected ? selected.value : '';
}

function updatePropertyFields() {
    const propertyType = getSelectedPropertyType();

    if (propertyType === 'demolition') {
        demolitionTypeWrapper.style.display = 'block';
        demolitionType.setAttribute('required', 'required');
    } else {
        demolitionTypeWrapper.style.display = 'none';
        demolitionType.removeAttribute('required');
        demolitionType.value = '';
    }

    if (propertyType === 'repair') {
        estimatedWasteInput.removeAttribute('readonly');
        estimatedWasteInput.placeholder = 'Enter estimated waste in ton';
        wasteHelpText.textContent = 'For repair and renovation, enter the waste manually in ton.';
    } else {
        estimatedWasteInput.setAttribute('readonly', 'readonly');
        estimatedWasteInput.placeholder = 'Calculated automatically';
    }

    updateEstimatedWaste();
}

function updateEstimatedWaste() {
    const propertyType = getSelectedPropertyType();
    const demolitionValue = demolitionType.value;
    const builtUpArea = parseFloat(builtUpAreaInput.value || '0');

    if (propertyType === 'repair') {
        wasteHelpText.textContent = 'For repair and renovation, enter the waste manually in ton.';
        updateCharges();
        return;
    }

    if (!propertyType || !builtUpArea || builtUpArea <= 0) {
        estimatedWasteInput.value = '';
        wasteHelpText.textContent = '';
        updateCharges();
        return;
    }

    let wastePerSqmKg = 0;
    let helpText = '';

    if (propertyType === 'vacant') {
        wastePerSqmKg = 50;
        helpText = 'Estimated as 50 kg per sq.m.';
    } else if (propertyType === 'demolition') {
        if (demolitionValue === 'pakka') {
            wastePerSqmKg = 500;
            helpText = 'Estimated as 500 kg per sq.m for pakka demolition.';
        } else if (demolitionValue === 'partial') {
            wastePerSqmKg = 300;
            helpText = 'Estimated as 300 kg per sq.m for partial demolition.';
        } else {
            estimatedWasteInput.value = '';
            wasteHelpText.textContent = 'Select demolition type to calculate waste.';
            updateCharges();
            return;
        }
    }

    const wasteKg = builtUpArea * wastePerSqmKg;
    const wasteTon = wasteKg / 1000;

    estimatedWasteInput.value = wasteTon.toFixed(2);
    wasteHelpText.textContent = helpText;
    updateCharges();
}

function updateCharges() {
    const waste = parseFloat(estimatedWasteInput.value || '0');

    if (!waste || waste <= 0) {
        processingCharges.value = '';
        transportationCharges.value = '';
        administrativeCharges.value = '';
        estimatedAmount.value = '';
        return;
    }

    const processCharge = (waste * 134).toFixed(2);
    const transportCharge = (waste * 770).toFixed(2);
    const adminCharge = (waste * 196).toFixed(2);
    const amount = (parseFloat(processCharge) + parseFloat(transportCharge) + parseFloat(adminCharge)).toFixed(2);

    processingCharges.value = `Rs. ${processCharge}`;
    transportationCharges.value = `Rs. ${transportCharge}`;
    administrativeCharges.value = `Rs. ${adminCharge}`;
    estimatedAmount.value = `Rs. ${amount}`;
}

function detectMyLocation() {
    locationStatus.textContent = '';

    if (!navigator.geolocation) {
        locationStatus.textContent = 'Geolocation is not supported by this browser.';
        return;
    }

    detectLocationBtn.disabled = true;
    locationStatus.textContent = 'Detecting location...';

    navigator.geolocation.getCurrentPosition(
        function(position) {
            latitudeInput.value = position.coords.latitude.toFixed(7);
            longitudeInput.value = position.coords.longitude.toFixed(7);
            locationStatus.textContent = 'Location detected successfully.';
            detectLocationBtn.disabled = false;
        },
        function(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    locationStatus.textContent = 'Location permission was denied.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    locationStatus.textContent = 'Location information is unavailable.';
                    break;
                case error.TIMEOUT:
                    locationStatus.textContent = 'Location request timed out.';
                    break;
                default:
                    locationStatus.textContent = 'Unable to detect location.';
                    break;
            }

            detectLocationBtn.disabled = false;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

projectRadios.forEach(radio => {
    radio.addEventListener('change', updatePropertyFields);
});

demolitionType.addEventListener('change', updateEstimatedWaste);
builtUpAreaInput.addEventListener('input', updateEstimatedWaste);
estimatedWasteInput.addEventListener('input', updateCharges);
detectLocationBtn.addEventListener('click', detectMyLocation);

form.addEventListener('submit', function(e) {
    e.stopPropagation();

    if (!form.checkValidity()) {
        e.preventDefault();
        form.classList.add('was-validated');
        return;
    }

    loader.style.display = 'inline-block';
    text.style.display = 'none';
    button.disabled = true;
});

updatePropertyFields();
updateEstimatedWaste();
updateCharges();

@if ($errors->any())
form.classList.add('was-validated');
@endif
</script>
@endsection
