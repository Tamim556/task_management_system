<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .landing-page {
            text-align: center;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="landing-page">
        <h1 class="mb-4">Welcome to Task Management System</h1>
        <p class="mb-4">Stay organized and boost your productivity with our task management solution.</p>
        @if (Route::has('login'))
            <nav class="d-flex justify-content-center">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="btn btn-primary btn-custom"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="btn btn-primary btn-custom"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="btn btn-success btn-custom"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
