<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dorm Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="bg-primary text-white">
    <div class="container py-3 d-flex justify-content-between align-items-center">
        <div class="fw-bold">Dorm System</div>

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">Dashboard</a>
            <a href="{{ route('rooms.index') }}" class="text-white text-decoration-none">Rooms</a>
            <a href="{{ route('students.index') }}" class="text-white text-decoration-none">Students</a>
            <a href="{{ route('payments.index') }}" class="text-white text-decoration-none">Payments</a>
            <a href="{{ route('reports.occupancy') }}" class="text-white text-decoration-none">Reports</a>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('users.index') }}" class="text-white text-decoration-none">Users</a>
            @endif

            <span>{{ auth()->user()->name ?? 'User' }}</span>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
