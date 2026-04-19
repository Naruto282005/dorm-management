<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, {{ $student->full_name }}!</h2>
    <p>You have been successfully registered in the dormitory system.</p>
    <p><strong>Student ID:</strong> {{ $student->student_id_number }}</p>
    <p><strong>Room:</strong> {{ $student->room->room_number ?? 'Not assigned yet' }}</p>
    <p>Thank you.</p>
</body>
</html>
