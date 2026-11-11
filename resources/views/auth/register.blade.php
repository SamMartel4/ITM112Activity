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
            font-family: Arial, sans-serif;
            background: #e9c8de;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .register-container {
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
            border-color: #91aeee;
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
            top: 58%;
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
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .alert {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="register-container">

    <h2>School Management System</h2>
    <p>Create your account</p>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <label>Full Name</label>
        <input type="text"
            name="name"
            placeholder="Enter your full name"
            value="{{ old('name') }}"
            required>

        <label>Email Address</label>
        <input type="email"
            name="email"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            required>

        <label>Password</label>

        <div class="password-wrapper">
            <input type="password"
                name="password"
                id="password"
                placeholder="Enter your password"
                required>

            <span class="toggle-password"
                onclick="togglePasswordVisibility('password', 'eyeIcon1', this)"
                title="Show password">

                <svg id="eyeIcon1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <path d="M2 2l20 20"/>
                    <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                    <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                    <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
                </svg>
            </span>
        </div>

        <label>Confirm Password</label>

        <div class="password-wrapper">
            <input type="password"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="Confirm your password"
                required>

            <span class="toggle-password"
                onclick="togglePasswordVisibility('password_confirmation', 'eyeIcon2', this)"
                title="Show password">

                <svg id="eyeIcon2"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">

                    <path d="M2 2l20 20"/>
                    <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                    <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                    <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
                </svg>
            </span>
        </div>

        <button type="submit">Register</button>

    </form>

    <p>
        Already have an account?
        <a href="{{ route('login') }}">Login here</a>
    </p>

</div>

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

        } else {

            password.type = 'password';

            eyeIcon.innerHTML = `
                <path d="M2 2l20 20"/>
                <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"/>
                <path d="M9.88 5.09A10.8 10.8 0 0 1 12 4.5c5 0 9 4.5 10 7.5a11.8 11.8 0 0 1-4.1 5.2"/>
                <path d="M6.61 6.61A12.1 12.1 0 0 0 2 12c1.4 3 5 7.5 10 7.5 1.4 0 2.7-.4 3.8-1"/>
            `;

            toggleElement.title = 'Show password';
        }
    }
</script>

</body>
</html>
