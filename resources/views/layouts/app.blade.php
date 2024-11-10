<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <title>@yield('title-name', 'Time Tracker')</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-fluid bg-primary bg-gradient mb-2 rounded-3">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand text-warning" href="#">Brand</a>
                <a href="{{ route('dashboard') }}" class="h2 link-underline link-underline-opacity-0">Time Tracker</a>
                <button class="navbar-toggler text-secondary" data-toggle="collapse" type="button" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">

                </div>
            </div>
        </nav>

        @yield('content')
        
        <a href="{{route('logout')}}">Logout</a>
        <footer class="footer">

        </footer>
    </body>
</html>
