<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teachers List</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #308c24;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 28px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, 0.08);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 40px;
        }

        .subtitle {
            margin-bottom: 25px;
            color: #308c24;
        }

        .success {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 7px;
            background: #dcfce7;
            color: #166534;
        }

        .add-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 11px 16px;
            background: #308c24;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .add-button:hover {
            background: #308c24;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
        }

        tbody tr:hover {
            background: #fafcff;
        }

        .teacher-name {
            font-weight: bold;
            color: #1e293b;
        }

        .email {
            color: #64748b;
            font-size: 13px;
            margin-top: 5px;
        }

        .item {
            display: inline-block;
            margin: 0 4px 6px 0;
            padding: 5px 9px;
            background: #eff6ff;
            color: #1d4ed8;
            border-radius: 5px;
            font-size: 13px;
        }

        .no-item {
            color: #94a3b8;
            font-size: 13px;
        }

        .actions {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            white-space: nowrap;
        }

        .btn-classes {
            background: #0d9488;
        }

        .btn-classes:hover {
            background: #0f766e;
        }

        .btn-subjects {
            background: #7c3aed;
        }

        .btn-subjects:hover {
            background: #6d28d9;
        }

        .empty-table {
            padding: 25px;
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Teachers List</h1>

    <p class="subtitle">
        Teacher information and class assignments
    </p>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('teachers.create') }}" class="add-button">
        + Add Teacher
    </a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Teacher</th>
                    <th>Assigned Classes</th>
                    <th>Assigned Subjects</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>

                        <td>
                            <div class="teacher-name">
                                {{ $teacher->first_name }}
                                {{ $teacher->last_name }}
                            </div>

                            <div class="email">
                                {{ $teacher->email }}
                            </div>
                        </td>

                        {{-- Assigned Classes --}}
                        <td>
                            @forelse ($teacher->schoolClasses as $class)
                                <span class="item">
                                    {{ $class->section_name }}
                                </span>
                            @empty
                                <span class="no-item">
                                    No classes assigned
                                </span>
                            @endforelse
                        </td>

                        {{-- Assigned Subjects --}}
                        <td>
                            @forelse ($teacher->subjects as $subject)
                                <span class="item">
                                    {{ $subject->name }}
                                </span>
                            @empty
                                <span class="no-item">
                                    No subjects assigned
                                </span>
                            @endforelse
                        </td>

                        {{-- Action Buttons --}}
                        <td>
                            <div class="actions">
                                <a
                                    href="{{ route('teachers.assign', $teacher->id) }}"
                                    class="btn btn-classes"
                                >
                                    Assign Classes
                                </a>

                                <a
                                    href="{{ route('teachers.subjects.edit', $teacher->id) }}"
                                    class="btn btn-subjects"
                                >
                                    Assign Subjects
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-table">
                            No teachers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
