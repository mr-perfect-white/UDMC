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

.form-text {
    font-size: 12px;
}
</style>

@section('content')
<main class="main">
    <div class="container py-5">
        <div class="col-lg-8 mx-auto">
            <div class="card form-card p-4">
                <div class="card-header mb-4" style="background:#1f4e79;">
                    <h4 class="text-center text-white mt-2">
                        UDMS - Waste Disposal Application Form
                    </h4>
                </div>

                <form id="applicationForm" class="needs-validation" method="POST" action="{{route('register.store')}}" novalidate>
                    @csrf

                    <div class="mb-4">
                        <div class="section-title d-flex flex-row align-items-end">
                            <div class="section-number">1</div>
                            Applicant Details
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Applicant Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    pattern="[A-Za-z ]+"
                                    oninput="this.value=this.value.replace(/[^A-Za-z ]/g,'')"
                                    placeholder="Enter your full name"
                                    value="{{ old('name') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter your full name</div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input
                                    type="tel"
                                    name="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    pattern="[0-9]{10}"
                                    maxlength="10"
                                    placeholder="Enter 10-digit mobile number"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    value="{{ old('mobile') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter valid 10 digit mobile number</div>
                                @error('mobile')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email ID <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your email address"
                                    value="{{ old('email') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter valid email</div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <div class="section-title d-flex flex-row align-items-end">
                            <div class="section-number">2</div>
                            Site And Project Information
                        </div>

                        <label class="form-label">Property Type <span class="text-danger">*</span></label>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input projectType @error('property_type') is-invalid @enderror"
                                    type="radio"
                                    name="property_type"
                                    value="vacant"
                                    {{ old('property_type') === 'vacant' ? 'checked' : '' }}
                                    required
                                >
                                <label class="form-check-label">Vacant Site</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input projectType @error('property_type') is-invalid @enderror"
                                    type="radio"
                                    name="property_type"
                                    value="demolition"
                                    {{ old('property_type') === 'demolition' ? 'checked' : '' }}
                                >
                                <label class="form-check-label">Demolition</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input projectType @error('property_type') is-invalid @enderror"
                                    type="radio"
                                    name="property_type"
                                    value="repair"
                                    {{ old('property_type') === 'repair' ? 'checked' : '' }}
                                >
                                <label class="form-check-label">Repair and Renovation</label>
                            </div>

                            @error('property_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="demolitionTypeWrapper" style="display:none;">
                            <label class="form-label">Demolition Type <span class="text-danger">*</span></label>
                            <select
                                name="demolition_type"
                                id="demolitionType"
                                class="form-select @error('demolition_type') is-invalid @enderror"
                            >
                                <option value="">Select Demolition Type</option>
                                <option value="pakka" {{ old('demolition_type') === 'pakka' ? 'selected' : '' }}>Pakka</option>
                                <option value="partial" {{ old('demolition_type') === 'partial' ? 'selected' : '' }}>Partial</option>
                            </select>
                            @error('demolition_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Site Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-house"></i></span>
                                <input
                                    type="text"
                                    name="site_address"
                                    class="form-control @error('site_address') is-invalid @enderror"
                                    placeholder="Enter complete site address"
                                    value="{{ old('site_address') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter site address</div>
                                @error('site_address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Ward Name <span class="text-danger">*</span></label>

        <select name="ward_id" class="form-select @error('ward_id') is-invalid @enderror" required>
            
            <option value="">Select Ward</option>

            @foreach($wards as $ward)
                <option value="{{ $ward->id }}" {{ old('ward_id') == $ward->id ? 'selected' : '' }}>
                    Ward {{ $ward->number }} - {{ $ward->name }}
                </option>
            @endforeach

        </select>

        <div class="invalid-feedback">Please select ward</div>

        @error('ward_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

    </div>
</div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Geo Location <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="latitude"
                                        id="latitude"
                                        class="form-control @error('latitude') is-invalid @enderror"
                                        oninput="this.value=this.value.replace(/[^0-9.-]/g,'')"
                                        placeholder="Latitude"
                                        value="{{ old('latitude') }}"
                                        required
                                    >
                                    <input
                                        type="text"
                                        name="longitude"
                                        id="longitude"
                                        class="form-control @error('longitude') is-invalid @enderror"
                                        oninput="this.value=this.value.replace(/[^0-9.-]/g,'')"
                                        placeholder="Longitude"
                                        value="{{ old('longitude') }}"
                                        required
                                    >
                                </div>
                                @error('latitude')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @error('longitude')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text" id="locationStatus"></div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-primary mb-3" id="detectLocationBtn">
                            <i class="bi bi-geo-alt"></i> Detect My Location
                        </button>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Built-up Area (sq.m) <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    name="built_up_area"
                                    id="builtUpArea"
                                    class="form-control @error('built_up_area') is-invalid @enderror"
                                    placeholder="Enter built-up area"
                                    value="{{ old('built_up_area') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter built-up area</div>
                                @error('built_up_area')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estimated Waste (Ton) <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    name="estimated_waste"
                                    id="estimatedWaste"
                                    class="form-control @error('estimated_waste') is-invalid @enderror"
                                    placeholder="Calculated automatically"
                                    value="{{ old('estimated_waste') }}"
                                    required
                                >
                                <div class="invalid-feedback">Please enter estimated waste</div>
                                <div class="form-text" id="wasteHelpText"></div>
                                @error('estimated_waste')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Processing Charges</label>
                                <input type="text" class="form-control" id="processingCharges" readonly placeholder="Calculated automatically">
                                <div class="form-text">Rs. 134 per ton.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Transportation Charges</label>
                                <input type="text" class="form-control" id="transportationCharges" readonly placeholder="Calculated automatically">
                                <div class="form-text">Rs. 770 per ton.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Administrative Charges</label>
                                <input type="text" class="form-control" id="administrativeCharges" readonly placeholder="Calculated automatically">
                                <div class="form-text">Rs. 196 per ton.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Amount</label>
                                <input type="text" class="form-control" id="estimatedAmount" readonly placeholder="Calculated automatically">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                            <span class="btn-text">
                                Proceed To Payment <i class="bi bi-arrow-right"></i>
                            </span>
                            <span class="loader spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </form>
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
