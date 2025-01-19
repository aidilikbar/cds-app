<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Clinical Decision Support')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-info text-white py-3">
        <div class="container">
            <h1 class="h3">Clinical Decision Support System</h1>
            <nav>
                <a href="{{ route('homepage') }}" class="text-white me-3">Home</a>
                <a href="{{ route('decision-support.index') }}" class="text-white me-3">Decision Support</a>
                <a href="#" class="text-white">Other Features</a>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; {{ date('Y') }} Clinical Decision Support</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>