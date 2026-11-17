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
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f5f1ff;
            color: #29213d;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 38px 32px;
            background: #ffffff;
            border: 1px solid #ebe4fa;
            border-radius: 16px;
            box-shadow: 0 12px 35px rgba(75, 45, 120, 0.08);
        }

        .logo {
            width: 55px;
            height: 55px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee7ff;
            color: #7042b5;
            border-radius: 14px;
            font-size: 25px;
            font-weight: bold;
        }

        h2 {
            margin: 0;
            text-align: center;
            font-size: 23px;
            color: #38245e;
        }

        .subtitle {
            margin: 10px 0 28px;
            text-align: center;
            color: #827792;
            font-size: 14px;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-size: 14px;
            font-weight: bold;
            color: #45345f;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #ded6ec;
            border-radius: 8px;
            background: #ffffff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #8054c7;
            box-shadow: 0 0 0 3px rgba(128, 84, 199, 0.12);
        }

        input::placeholder {
            color: #aaa1b8;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            color: #817492;
            cursor: pointer;
        }

        .toggle-password svg {
            width: 21px;
            height: 21px;
        }

        .toggle-password:focus {
            outline: 2px solid #8054c7;
            border-radius: 4px;
        }

        .login-button {
            width: 100%;
            margin-top: 26px;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #7042b5;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-button:hover {
            background: #593394;
        }

        button:disabled,
        input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px;
            border: 1px solid #f2caca;
            border-radius: 8px;
            background: #fff0f0;
            color: #a83232;
            font-size: 13px;
            line-height: 1.5;
        }

        .alert p {
            margin: 8px 0;
        }

        .timer {
            margin: 15px 0;
            color: #c03939;
            font-size: 34px;
            font-weight: bold;
            text-align: center;
        }

        .register-link {
            margin-top: 23px;
            text-align: center;
            color: #827792;
            font-size: 14px;
        }

        .register-link a {
            color: #7042b5;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #aaa1b8;
            font-size: 11px;
        }

        @media (max-width: 420px) {
            .login-container {
                padding: 30px 23px;
            }

            h2 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">S</div>

    <h2>Welcome Back!</h2>

    <p class="subtitle">
        School Management System<br>
        Sign in to continue to your account.
    </p>

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

        {{-- Display validation and login errors --}}
        @if ($errors->any())

            <div class="alert" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>

        @endif

    @endif

    <form action="{{ route('login.submit') }}" method="POST">

        @csrf

        <label for="email">Email Address</label>

        <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            autocomplete="username"
            required
            @if(session('lockout_seconds')) disabled @endif
        >

        <label for="password">Password</label>

        <div class="password-wrapper">

            <input
                type="password"
                name="password"
                id="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
                @if(session('lockout_seconds')) disabled @endif
            >

            <span
                class="toggle-password"
                id="togglePassword"
                role="button"
                tabindex="0"
                onclick="togglePasswordVisibility()"
                onkeydown="if(event.key === 'Enter' || event.key === ' ') { event.preventDefault(); togglePasswordVisibility(); }"
                title="Show password"
                aria-label="Show password"
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
            class="login-button"
            id="loginButton"
            @if(session('lockout_seconds')) disabled @endif
        >
            Sign In
        </button>

    </form>

    <p class="register-link">
        Don't have an account?
        <a href="{{ route('register') }}">Create an account</a>
    </p>

    <div class="footer">
        &copy; {{ date('Y') }} School Management System
    </div>

</div>

{{-- Show / Hide Password --}}
<script>
    function togglePasswordVisibility() {

        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const toggle = document.getElementById('togglePassword');

        const isHidden = password.type === 'password';

        if (isHidden) {

            password.type = 'text';

            eyeIcon.innerHTML = `
                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
                <circle cx="12" cy="12" r="3"/>
            `;

            toggle.title = 'Hide password';
            toggle.setAttribute('aria-label', 'Hide password');

        } else {

            password.type = 'password';

            eyeIcon.innerHTML = `
                <path d="M2 2l20 20"/>
                <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
            `;

            toggle.title = 'Show password';
            toggle.setAttribute('aria-label', 'Show password');
        }
    }
</script>

{{-- Lockout Countdown Timer --}}
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

