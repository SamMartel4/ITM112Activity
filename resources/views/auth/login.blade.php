<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | School Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #c7e4c5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: white;
            width: 90%;
            max-width: 400px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #1e293b;
        }

        p {
            text-align: center;
            color: #64748b;
        }

        label {
            display: block;
            margin-top: 18px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            outline: none;
        }

        input:focus {
            border-color: #efe9ed;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 22px;
            height: 22px;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password svg {
            width: 22px;
            height: 22px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background: #308c24;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #43b034;
        }

        button:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .alert {
            background: #fee2e2;
            border: 1px solid #e6e2e4;
            color: #b91c1c;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        .timer {
            font-size: 35px;
            font-weight: bold;
            color: #b72d3d;
            margin: 15px 0;
        }
    </style>
</head>

<body>

<div class="login-container">

    <h2>School Management System</h2>
    <p>Sign in to your account</p>

    {{-- Lockout warning and countdown --}}
    @if (session('lockout_seconds'))

        <div class="alert">

            <strong>Too Many Attempts!</strong>

            <p>You have entered the wrong password too many times.</p>

            <p>Please wait before trying again.</p>

            <div class="timer" id="countdown">05:00</div>

            <small>Time remaining</small>

        </div>

    @else

        {{-- Display errors --}}
        @if ($errors->any())

            <div class="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>

        @endif

    @endif

    <form action="{{ route('login.submit') }}" method="POST">

        @csrf

        <label>Email Address</label>

        <input
            type="email"
            name="email"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            required
            @if(session('lockout_seconds')) disabled @endif
        >

        <label>Password</label>

        <div class="password-wrapper">

            <input
                type="password"
                name="password"
                id="password"
                placeholder="Enter your password"
                required
                @if(session('lockout_seconds')) disabled @endif
            >

            {{-- Eye icon with slash --}}
            <span
                class="toggle-password"
                id="togglePassword"
                onclick="togglePasswordVisibility()"
                title="Show password"
            >
                <svg
                    id="eyeIcon"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M2 2l20 20"/>
                    <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                    <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                    <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
                </svg>
            </span>

        </div>

        <button
            type="submit"
            id="loginButton"
            @if(session('lockout_seconds')) disabled @endif
        >
            Login
        </button>

    </form>

    <p style="text-align:center; margin-top:20px;">
    Don't have an account?
    <a href="{{ route('register') }}">Register here</a>
</p>

</div>

{{-- Show / Hide Password --}}
<script>
    function togglePasswordVisibility() {

        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const togglePassword = document.getElementById('togglePassword');

        const isHidden = password.type === 'password';

        if (isHidden) {

            password.type = 'text';

            // Eye icon without slash
            eyeIcon.innerHTML = `
                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
                <circle cx="12" cy="12" r="3"/>
            `;

            togglePassword.title = 'Hide password';

        } else {

            password.type = 'password';

            // Eye icon with slash
            eyeIcon.innerHTML = `
                <path d="M2 2l20 20"/>
                <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
            `;

            togglePassword.title = 'Show password';
        }
    }
</script>

{{-- Countdown Timer --}}
@if (session('lockout_seconds'))

<script>

    let remaining = {{ (int) session('lockout_seconds') }};

    const countdown = document.getElementById('countdown');

    function updateCountdown() {

        let minutes = Math.floor(remaining / 60);
        let seconds = remaining % 60;

        countdown.textContent =
            String(minutes).padStart(2, '0') + ':' +
            String(seconds).padStart(2, '0');

        if (remaining <= 0) {

            countdown.textContent = '00:00';

            location.reload();

            return;
        }

        remaining--;

        setTimeout(updateCountdown, 1000);
    }

    updateCountdown();

</script>

@endif

</body>
</html>
