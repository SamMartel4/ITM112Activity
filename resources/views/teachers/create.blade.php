<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher | School System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #e76ab7;
        }

        .sidebar {
            width: 235px;
            background: #e76ab7;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 28px 18px;
        }

        .sidebar h2 {
            font-size: 21px;
            margin: 0 0 35px;
        }

        .sidebar a {
            display: block;
            padding: 13px;
            margin-bottom: 8px;
            color: #dbeafe;
            text-decoration: none;
            border-radius: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #853164;
            color: white;
        }

        .main {
            margin-left: 235px;
            padding: 35px;
        }

        .topbar {
            margin-bottom: 28px;
        }

        h1 {
            margin: 0 0 9px;
            font-size: 28px;
        }

        .muted {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-card {
            background: white;
            max-width: 800px;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 18px #0f172a0a;
        }

        .form-card h2 {
            font-size: 20px;
            margin: 0 0 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin-top: 28px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background: #fff;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #2563eb20;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #e8edf4;
        }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #e76ab7;
            color: white;
        }

        .btn-primary:hover {
            background: #e76ab7;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .required {
            color: #dc2626;
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 16px;
            }

            .sidebar h2 {
                margin-bottom: 15px;
            }

            .sidebar a {
                display: inline-block;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .form-card {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <h2>School System</h2>

        <a href="{{ url('/students') }}">Students Record</a>

        <a href="{{ route('teachers.index') }}" class="active">
            Teacher Management
        </a>
    </aside>

    <main class="main">

        <div class="topbar">
            <h1>Add Teacher</h1>
            
        </div>

        <section class="form-card">

            <h2>Teacher Information</h2>

            <p class="muted">
                Fill in the information below to register a new teacher.
            </p>

            @if ($errors->any())
                <div style="background:#fef2f2; padding:14px; border-radius:8px; margin-top:20px;">
                    <strong style="color:#b91c1c;">
                        Please check the following errors:
                    </strong>

                    <ul style="color:#b91c1c; margin-bottom:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="field">
                        <label for="first_name">
                            First Name <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="Enter first name"
                            maxlength="255"
                            required
                        >

                        @error('first_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="last_name">
                            Last Name <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="Enter last name"
                            maxlength="255"
                            required
                        >

                        @error('last_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field full">
                        <label for="email">
                            Email Address <span class="required">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="example@email.com"
                            maxlength="255"
                            required
                        >

                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        
                    </div>
                    

<!-- Many-to-Many: Select Subjects -->
<div class="mb-3">
    <label class="form-label">Assign Subjects</label>

    @forelse ($subjects as $subject)
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                name="subject_ids[]"
                value="{{ $subject->id }}"
                id="subject_{{ $subject->id }}"
            >

            <label
                class="form-check-label"
                for="subject_{{ $subject->id }}"
            >
                {{ $subject->name }}
            </label>
        </div>
    @empty
        <p>No subjects available. Please add subjects first.</p>
    @endforelse
</div>


    @error('subject_ids')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    @error('subject_ids.*')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


                </div>

                <div class="actions">
                    <a href="{{ route('teachers.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Save Teacher
                    </button>
                </div>

            </form>
        </section>

    </main>

</body>
</html>
