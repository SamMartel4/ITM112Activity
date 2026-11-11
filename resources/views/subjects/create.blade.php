
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #308c24;
        }

        .container {
            max-width: 650px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #308c24;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd2da;
            border-radius: 6px;
            font-size: 15px;
        }

        select[multiple] {
            min-height: 180px;
        }

        small {
            display: block;
            margin-top: 8px;
            color: #667085;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 14px;
        }

        .success {
            padding: 12px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button,
        .back-btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
        }

        button {
            background: #308c24;
            color: white;
        }

        button:hover {
            background: #308c24;
        }

        .back-btn {
            background: #e5e7eb;
            color: #333;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            button,
            .back-btn {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Add Subject</h1>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf

            <!-- Subject Name -->
            <div class="form-group">
                <label for="name">Subject Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter subject name"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subject Code -->
            <div class="form-group">
                <label for="code">Subject Code</label>

                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code') }}"
                    placeholder="Enter subject code"
                    required
                >

                @error('code')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Select Multiple Teachers -->
            <div class="form-group">
                <label for="teachers">Select Teachers</label>

                <select
                    name="teachers[]"
                    id="teachers"
                    multiple
                    required
                >
                    @foreach ($teachers as $teacher)
                        <option
                            value="{{ $teacher->id }}"
                            {{ in_array(
                                $teacher->id,
                                old('teachers', [])
                            ) ? 'selected' : '' }}
                        >
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>

                @error('teachers')
                    <div class="error">{{ $message }}</div>
                @enderror

                @error('teachers.*')
                    <div class="error">{{ $message }}</div>
                @enderror

                
            </div>

            <!-- Buttons -->
            <div class="buttons">
                <button type="submit">
                    Save Subject
                </button>

                <a
                    href="{{ route('subjects.index') }}"
                    class="back-btn"
                >
                    Back to Subjects
                </a>
            </div>

        </form>
    </div>
</body>
</html>
