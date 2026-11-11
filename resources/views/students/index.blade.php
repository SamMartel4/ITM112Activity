<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        h1 { color: #1e3a8a; }
        .add {
            display: inline-block;
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th { background: #e2e8f0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>School Management System</h1>
        <h2>Student Records</h2>

        @if(session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif

        <a class="add" href="{{ route('students.create') }}">
            + Add Student
        </a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Birth Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->birth_date ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No students found. Click Add Student to begin.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
