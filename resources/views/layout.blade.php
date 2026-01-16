<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Page Title -->
  <title>@yield('title', 'ShareAMeal')</title>

  <!-- Base CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- Page-specific CSS -->
  @stack('page-css')
   
  @stack('page-js')
</head>
<body class="@yield('body-class', '')">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="{{ route('mainpage') }}" class="logo d-flex align-items-center me-auto">
      <img src="{{ asset('assets/img/ShareAMeal.png') }}" alt="ShareAMeal Logo">
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('mainpage') }}">Home</a></li>
        <li><a href="{{ route('feed') }}">Main Feed</a></li>
        <li><a href="{{ route('myposts') }}">My Posts</a></li>

        @guest
          <li><a href="{{ route('login') }}">Login</a></li>
        @endguest

        @auth
          <li><a href="{{ route('profile') }}">Profile</a></li>

          @if(auth()->user()->is_admin)
            <li>
              <a href="{{ route('admin.reports') }}" class="{{ Request::routeIs('admin.reports') ? 'active' : '' }}">Admin</a>
            </li>
          @endif
          
        @endauth
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

  </div>
</header>
  <!-- End Header -->

  <!-- ======= Main Content ======= -->
  <main class="container mt-5">
    @yield('content')
  </main>
  <!-- End Main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer dark-background mt-4">
    <div class="container text-center py-4">
      <p>© ShareAMeal - All Rights Reserved</p>
      @yield('extra-footer') {{-- optional extra footer content --}}
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Base JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Page-specific JS -->
  @yield('extra-js')

</body>
</html>
