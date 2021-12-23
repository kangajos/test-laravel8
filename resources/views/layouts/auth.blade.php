<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BANK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">BANK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('beginer.duplikat') }}">Duplikasi Huruf</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('beginer.tangga') }}">Tangga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.index') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('topup.index') }}">Top Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('withdraw.index') }}">Withdraw</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mutation.index') }}">Mutasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if (session('error'))
        <div class="container text-center">
            <div class="aler alert-danger">{{ session('error') }}</div>
        </div>
    @endif
    @if (session('success'))
        <div class="container text-center">
            <div class="aler alert-success">{{ session('success') }}</div>
        </div>
    @endif
    @yield('content')

</body>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
