<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assign Classes</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #243047;
        }

        .container {
            max-width: 750px;
            margin: 30px auto;
            padding: 28px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0f172a12;
        }

        h1 {
            margin-top: 0;
            font-size: 27px;
        }

        .teacher-info {
            color: #64748b;
            margin-bottom: 24px;
        }

        .class-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
        }

        .class-item:hover {
            background: #f8fafc;
        }

        .class-item input {
            width: 17px;
            height: 17px;
            cursor: pointer;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-back {
            background: #64748b;
        }

        .btn-back:hover {
            background: #475569;
        }

        .message {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 7px;
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            padding: 16px;
            background: #f8fafc;
            border-radius: 8px;
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Assign Classes</h1>

    <p class="teacher-info">
        Teacher:
        <strong>
            {{ $teacher->first_name }} {{ $teacher->last_name }}
        </strong>
    </p>

    @if ($errors->any())
        <div class="message">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form
        action="{{ route('teachers.assign.update', $teacher->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        @forelse ($classes as $class)

            <label class="class-item">

                <input
                    type="checkbox"
                    name="class_ids[]"
                    value="{{ $class->id }}"
                    @checked(
                        in_array(
                            $class->id,
                            old(
                                'class_ids',
                                $teacher->schoolClasses->pluck('id')->toArray()
                            )
                        )
                    )
                    @disabled(
                        $class->teacher_id !== null &&
                        $class->teacher_id != $teacher->id
                    )
                >

                <span>
                    {{ $class->section_name }}

                    @if (
                        $class->teacher_id !== null &&
                        $class->teacher_id != $teacher->id
                    )
                        <small>(Assigned to another teacher)</small>
                    @endif
                </span>

            </label>

        @empty

            <div class="empty">
                Walay classes nga available. Paghimo una og class.
            </div>

        @endforelse

        @error('class_ids')
            <p style="color: #dc2626;">{{ $message }}</p>
        @enderror

        <div class="buttons">

            <button type="submit" class="btn">
                Save Assignments
            </button>

            <a
                href="{{ route('teachers.index') }}"
                class="btn btn-back"
            >
                Back to Teachers
            </a>

        </div>

    </form>

</div>

</body>
</html>
