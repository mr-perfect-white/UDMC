<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Owner Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* 🔥 Full screen background */
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Background image with overlay */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1601584115197-04ecc0da31d7') no-repeat center center/cover;
            filter: brightness(0.5);
            z-index: -1;
        }

        /* Card */
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            color: #fff;
        }

        .login-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .vehicle-icon {
            font-size: 40px;
            text-align: center;
            margin-bottom: 10px;
            color: #fff;
        }

        .form-label {
            color: #fff;
        }

        .form-control {
            border-radius: 10px;
            background: rgba(255,255,255,0.8);
        }

        .btn-login {
            background: #2a5780;
            border: none;
            border-radius: 10px;
        }

        .btn-login:hover {
            background: #1d3e5c;
        }

        .toggle-password {
            cursor: pointer;
            color: #000;
        }
        .top-50 {
    top: 70% !important;
}
    </style>
</head>

<body>

<div class="login-card">

    <div class="vehicle-icon">
        <i class="fa-solid fa-truck"></i>
    </div>

    <h4 class="login-title">Vehicle Owner Login</h4>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('vehicle.login.post') }}">
        @csrf

        <!-- Mobile -->
        <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" name="mobile" class="form-control" placeholder="Enter mobile number" required>
        </div>

        <!-- Password -->
        <div class="mb-3 position-relative">
            <label class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>

            <span class="position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" onclick="togglePassword()">
                <i class="fa fa-eye"></i>
            </span>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-login w-100 text-white">
            Login
        </button>

    </form>

</div>

<script>
function togglePassword() {
    let input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

</body>
</html>