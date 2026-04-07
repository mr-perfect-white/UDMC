<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Razorpay -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <style>
        body {
            background: #f4f6f9;
        }
        .card {
            border-radius: 12px;
        }
        .title {
            font-weight: 600;
            color: #1f4e79;
        }
        .amount {
            font-size: 28px;
            font-weight: bold;
            color: #28a745;
        }
        .btn-pay {
            background: #1f4e79;
            border: none;
        }
        .btn-pay:hover {
            background: #163b5c;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow p-4">
                
                <h4 class="text-center title mb-4">Payment Summary</h4>

                <!-- User Details -->
                <div class="mb-3">
                    <strong>Name:</strong> {{ $register->name }}
                </div>

                <div class="mb-3">
                    <strong>Mobile:</strong> {{ $register->mobile }}
                </div>

                <div class="mb-3">
                    <strong>Email:</strong> {{ $register->email }}
                </div>

                <div class="mb-3">
                    <strong>Property Type:</strong> {{ ucfirst($register->property_type) }}
                </div>

                <div class="mb-3">
                    <strong>Estimated Waste:</strong> {{ $register->estimated_waste }} Ton
                </div>

                <hr>

                <!-- Amount -->
                <div class="text-center mb-4">
                    <div>Total Amount</div>
                    <div class="amount">₹ {{ number_format($amount, 2) }}</div>
                </div>

                <!-- Pay Button -->
                <div class="d-grid">
                    <button id="payBtn" class="btn btn-pay text-white py-2">
                        Proceed to Pay
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
var options = {
    "key": "{{ config('services.razorpay.key') }}",
    "amount": "{{ $order['amount'] }}",
    "currency": "INR",
    "name": "UDMS Payment",
    "description": "Waste Disposal Charges",
    "order_id": "{{ $order['id'] }}",

    "handler": function (response){
        fetch("{{ route('payment.success') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                ...response,
                register_id: "{{ $register->id }}"
            })
        }).then(() => {
            window.location.href = "{{ route('status') }}";
        });
    }
};

var rzp = new Razorpay(options);

document.getElementById('payBtn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>

</body>
</html>