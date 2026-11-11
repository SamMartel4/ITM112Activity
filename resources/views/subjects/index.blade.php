<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Subjects</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f6f9;
            color: #333;
        }

        h1 {
            color: #181918;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .errors {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .add-btn {
            display: inline-block;
            background-color: #308c24;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background-color: #308c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #308c24;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            color: #308c24;
            text-decoration: none;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            body {
                margin: 15px;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>

    <h1>Subject Management System</h1>
    <h2>View Subjects</h2>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="errors">
            <strong>Please check the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add Subject Button --}}
    <a href="{{ route('subjects.create') }}" class="add-btn">
        + Add Subject
    </a>

    {{-- Subjects Table --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Teacher</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code ?? 'N/A' }}</td>
                    <td>
                        {{ $subject->teacher?->name ?? 'Not assigned' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">
                        No subjects found. Click "Add Subject" to create one.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="/" class="back-btn">Back to Home</a>

</body>
</html>
