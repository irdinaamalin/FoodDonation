<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Logis Bootstrap --}}
    <link href="{{ asset('logis/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('logis/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mainpage.css') }}" rel="stylesheet">
</head>

<body>

<!-- ===== HEADER ===== -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ route('mainpage') }}" class="logo d-flex align-items-center">
            <h1>share<span>Ameal</span></h1>
        </a>

        <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('mainpage') }}" class="{{ Request::routeIs('mainpage') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('feed') }}" class="{{ Request::routeIs('feed') ? 'active' : '' }}">Main Feed</a></li>
        <li><a href="{{ route('myposts') }}" class="{{ Request::routeIs('myposts') ? 'active' : '' }}">My Posts</a></li>
        
        @guest
            <li><a href="{{ route('login') }}" class="{{ Request::routeIs('login') ? 'active' : '' }}">Login</a></li>
        @endguest

        @auth
            <li><a href="{{ route('profile') }}" class="{{ Request::routeIs('profile') ? 'active' : '' }}">Profile</a></li>
            
            {{-- ADMIN ONLY LINK --}}
            @if(Auth::user()->is_admin)
                <li><a href="{{ route('admin.reports') }}" style="color: #FFD700 !important;">Moderation Panel</a></li>
            @endif

            {{-- Logout Button --}}
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #fff; padding: 0 15px;">Logout</button>
                </form>
            </li>
        @endauth
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

    </div>
</header>

<div class="main-hero text-center">

    <h2>Welcome to ShareAMeal</h2>
    <p>Share food, reduce waste, and help the community 🌱</p>

    @auth
        <a href="{{ route('profile') }}" class="btn btn-primary btn-lg">
            Go to Profile
        </a>

        <div class="mt-3">
            <a href="{{ route('myposts') }}" class="btn btn-outline-primary btn-lg">
                View My Posts
            </a>
        </div>
    @endauth

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
            Login to Continue
        </a>
    @endguest

</div>

<!-- ===== FOOTER ===== -->
<footer id="footer" class="footer mt-5">
    <div class="container text-center">
        © ShareAMeal | admin.shareameal@gmail.com
    </div>
</footer>

<script src="{{ asset('logis/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

