<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Student Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Room</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->student_id_number }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->course }}</td>
                    <td>{{ $student->room->room_number ?? 'N/A' }}</td>
                    <td>{{ $student->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
