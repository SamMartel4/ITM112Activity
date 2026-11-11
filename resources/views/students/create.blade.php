<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 { color: #308c24; }

        label {
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background: #308c24;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back {
            margin-left: 10px;
            color: #308c24;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add New Student</h1>

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <label for="first_name">First Name</label>
        <input id="first_name" type="text" name="first_name"
               value="{{ old('first_name') }}" required>

        <label for="last_name">Last Name</label>
        <input id="last_name" type="text" name="last_name"
               value="{{ old('last_name') }}" required>

        <label for="email">Email</label>
        <input id="email" type="email" name="email"
               value="{{ old('email') }}" required>

        <label for="birth_date">Birth Date</label>
        <input id="birth_date" type="date" name="birth_date"
               value="{{ old('birth_date') }}">

        <button type="submit">Save Student</button>

        <a class="back" href="{{ route('students.index') }}">Back</a>
    </form>
</div>

</body>
</html>
