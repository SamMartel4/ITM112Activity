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
            background: #f5f1ff;
            color: #29213d;
        }

        .navbar {
            background: #7042b5;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .navbar h2 {
            margin: 0;
            font-size: 21px;
        }

        .logout {
            background: white;
            color: #7042b5;
            border: none;
            padding: 11px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout:hover {
            background: #eee7ff;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 35px 25px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            color: #38245e;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .welcome p {
            color: #827792;
            font-size: 15px;
        }

        .section-title {
            color: #38245e;
            margin-bottom: 18px;
            font-size: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            padding: 27px;
            border: 1px solid #ebe4fa;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(75, 45, 120, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(75, 45, 120, 0.10);
        }

        .card h3 {
            color: #38245e;
            margin: 0 0 12px;
            font-size: 18px;
        }

        .card p {
            color: #827792;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .card a {
            display: inline-block;
            background: #7042b5;
            color: white;
            padding: 11px 17px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .card a:hover {
            background: #593394;
        }

        .footer {
            margin-top: 45px;
            text-align: center;
            color: #aaa1b8;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 17px 18px;
            }

            .navbar h2 {
                font-size: 16px;
            }

            .logout {
                padding: 9px 13px;
                font-size: 12px;
            }

            .container {
                padding: 25px 18px;
            }

            .welcome h1 {
                font-size: 23px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
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

    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are successfully logged in.</p>
    </div>

    <h2 class="section-title">Management Overview</h2>

    <div class="cards">

        <div class="card">
            <h3>Student Management</h3>
            <p>Manage student records and information.</p>
            <a href="{{ route('students.index') }}">View Students</a>
        </div>

        <div class="card">
            <h3>Teacher Management</h3>
            <p>Manage teacher information and records.</p>
            <a href="{{ route('teachers.index') }}">View Teachers</a>
        </div>

        <div class="card">
            <h3>Subject Management</h3>
            <p>Manage school subjects and information.</p>
            <a href="{{ route('subjects.index') }}">View Subjects</a>
        </div>

    </div>

    <div class="footer">
        &copy; {{ date('Y') }} School Management System
    </div>

</div>

</body>
</html>

