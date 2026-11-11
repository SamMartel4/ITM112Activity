<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | School Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        .navbar {
            background: #e76ab7;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .logout {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        .container {
            padding: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px #e76ab7(0,0,0,0.05);
        }

        .card h3 {
            color: #1e293b;
        }

        .card a {
            color: #e76ab7;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="navbar">
    <h2>School Management System</h2>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout" type="submit">Logout</button>
    </form>
</div>

<div class="container">

    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>You are successfully logged in.</p>

    <div class="cards">

        <div class="card">
            <h3>Student Management</h3>
            <p>Manage student records.</p>
            <a href="{{ route('students.index') }}">View Students</a>
        </div>

        <div class="card">
            <h3>Teacher Management</h3>
            <p>Manage teacher information.</p>
            <a href="{{ route('teachers.index') }}">View Teachers</a>
        </div>

        <div class="card">
            <h3>Subject Management</h3>
            <p>Manage school subjects.</p>
            <a href="{{ route('subjects.index') }}">View Subjects</a>
        </div>

    </div>

</div>

</body>
</html>