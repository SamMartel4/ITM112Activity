<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Subjects</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            padding: 30px;
            color: #243047;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0001;
        }

        .subject {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        button, .back {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .back {
            background: #64748b;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Assign Subjects</h1>

    <h3>
        Teacher:
        {{ $teacher->first_name }} {{ $teacher->last_name }}
    </h3>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('teachers.subjects.update', $teacher->id) }}"
    >
        @csrf
        @method('PUT')

        @forelse($subjects as $subject)
            <div class="subject">
                <label>
                    <input
                        type="checkbox"
                        name="subjects[]"
                        value="{{ $subject->id }}"
                        @checked(
                            in_array(
                                $subject->id,
                                old(
                                    'subjects',
                                    $teacher->subjects->pluck('id')->all()
                                )
                            )
                        )
                    >

                    {{ $subject->name }}
                    @if($subject->code)
                        ({{ $subject->code }})
                    @endif
                </label>
            </div>
        @empty
            <p>Wala pay subjects sa database.</p>
            <a href="{{ url('/subjects') }}">Add or View Subjects</a>
        @endforelse

        <button type="submit">Save Assignments</button>

        <a href="{{ route('teachers.index') }}" class="back">
            Back to Teachers
        </a>
    </form>
</div>

</body>
</html>
