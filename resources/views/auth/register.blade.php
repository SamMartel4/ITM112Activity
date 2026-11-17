<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | School Management System</title>

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

        .register-container {
            width: 100%;
            max-width: 420px;
            padding: 35px 32px;
            background: #ffffff;
            border: 1px solid #ebe4fa;
            border-radius: 16px;
            box-shadow: 0 12px 35px rgba(75, 45, 120, 0.08);
        }

        .logo {
            width: 55px;
            height: 55px;
            margin: 0 auto 17px;
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
            margin: 10px 0 23px;
            text-align: center;
            color: #827792;
            font-size: 14px;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 16px 0 8px;
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

        .register-button {
            width: 100%;
            margin-top: 25px;
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

        .register-button:hover {
            background: #593394;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px;
            border: 1px solid #f2caca;
            border-radius: 8px;
            background: #fff0f0;
            color: #a83232;
            font-size: 13px;
            line-height: 1.5;
        }

        .login-link {
            margin-top: 22px;
            text-align: center;
            color: #827792;
            font-size: 14px;
        }

        .login-link a {
            color: #7042b5;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 23px;
            text-align: center;
            color: #aaa1b8;
            font-size: 11px;
        }

        @media (max-width: 420px) {
            .register-container {
                padding: 28px 22px;
            }

            h2 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="logo">S</div>

    <h2>Create Account</h2>

    <p class="subtitle">
        School Management System<br>
        Register to get started.
    </p>

    {{-- Display validation errors --}}
    @if ($errors->any())

        <div class="alert" role="alert">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>

    @endif

    <form action="{{ route('register.submit') }}" method="POST">

        @csrf

        <label for="name">Full Name</label>

        <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your full name"
            value="{{ old('name') }}"
            autocomplete="name"
            required
        >

        <label for="email">Email Address</label>

        <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            autocomplete="email"
            required
        >

        <label for="password">Password</label>

        <div class="password-wrapper">

            <input
                type="password"
                name="password"
                id="password"
                placeholder="Create your password"
                autocomplete="new-password"
                required
            >

            <span
                class="toggle-password"
                role="button"
                tabindex="0"
                onclick="togglePasswordVisibility('password', 'eyeIcon1', this)"
                onkeydown="if(event.key === 'Enter' || event.key === ' ') { event.preventDefault(); togglePasswordVisibility('password', 'eyeIcon1', this); }"
                title="Show password"
                aria-label="Show password"
            >

                <svg
                    id="eyeIcon1"
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

        <label for="password_confirmation">Confirm Password</label>

        <div class="password-wrapper">

            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="Confirm your password"
                autocomplete="new-password"
                required
            >

            <span
                class="toggle-password"
                role="button"
                tabindex="0"
                onclick="togglePasswordVisibility('password_confirmation', 'eyeIcon2', this)"
                onkeydown="if(event.key === 'Enter' || event.key === ' ') { event.preventDefault(); togglePasswordVisibility('password_confirmation', 'eyeIcon2', this); }"
                title="Show password"
                aria-label="Show password"
            >

                <svg
                    id="eyeIcon2"
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

        <button type="submit" class="register-button">
            Create Account
        </button>

    </form>

    <p class="login-link">
        Already have an account?
        <a href="{{ route('login') }}">Sign in here</a>
    </p>

    <div class="footer">
        &copy; {{ date('Y') }} School Management System
    </div>

</div>

{{-- Show / Hide Password --}}
<script>
    function togglePasswordVisibility(inputId, iconId, toggleElement) {

        const password = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        const isHidden = password.type === 'password';

        if (isHidden) {

            password.type = 'text';

            eyeIcon.innerHTML = `
                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
                <circle cx="12" cy="12" r="3"/>
            `;

            toggleElement.title = 'Hide password';
            toggleElement.setAttribute('aria-label', 'Hide password');

        } else {

            password.type = 'password';

            eyeIcon.innerHTML = `
                <path d="M2 2l20 20"/>
                <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
            `;

            toggleElement.title = 'Show password';
            toggleElement.setAttribute('aria-label', 'Show password');
        }
    }
</script>

</body>
</html>
