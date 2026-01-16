<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Posts - ShareAMeal</title>


    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://fonts.cdnfonts.com/css/tex-gyre-termes" rel="stylesheet">

    <link href="{{ asset('assets/css/myposts.css') }}" rel="stylesheet">

    @push('page-js')
    <script src="{{ asset('assets/js/myposts.js') }}"></script>
    @endpush

</head>



<body class="my-posts-page">


    <header id="header" class="header d-flex align-items-center fixed-top">

        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('mainpage') }}" class="logo d-flex align-items-center me-auto">

                <img src="{{ asset('assets/img/ShareAMeal.png') }}" alt="ShareAMeal Logo">

            </a>

            <nav id="navmenu" class="navmenu">

                <ul>

                    <li><a href="{{ route('mainpage') }}" class="{{ Request::routeIs('mainpage') ? 'active' : '' }}">Home</a></li>

                    <li><a href="{{ route('feed') }}" class="{{ Request::routeIs('feed') ? 'active' : '' }}">Main Feed</a></li>

                    <li><a href="{{ route('myposts') }}" class="{{ Request::routeIs('myposts') ? 'active' : '' }}">My Posts</a></li>

                    @guest

                        <li><a href="{{ route('login') }}">Login</a></li>

                    @endguest

                    @auth

                        <li><a href="{{ route('profile') }}">Profile</a></li>

                    @endauth

                </ul>

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

            </nav>

        </div>

    </header>



    <main class="container">

        <div class="posts-hero-outer">

            <div class="posts-hero-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://www.sufra-nwlondon.org.uk/wp-content/uploads/2024/01/Donate-Food-header-1.jpg');">

                <div class="hero-content">

                    <h1 class="hero-title">My Posts</h1>

                </div>

            </div>

        </div>



        <div id="gs-posts-wrapper" style="max-width:1100px;margin:28px auto;color:#111;">

            <div class="search-bar-container">

                <input type="text" id="search-input" placeholder="Search posts...">

                <select id="sort-select">

                    <option value="">Sort by</option>

                    <option value="newest">Newest</option>

                    <option value="oldest">Oldest</option>

                    <option value="views">Most Viewed</option>

                </select>

                <select id="filter-select">

                    <option value="">Filter by status</option>

                    <option value="ACTIVE">Active</option>

                    <option value="CLAIMED">Claimed</option>

                    <option value="COMPLETED">Completed</option>

                    <option value="EXPIRED">Expired</option>

                </select>

                <a class="gs-update" href="https://sites.google.com/view/iiumfoodsharing/create-post" target="_blank" style="background: #000; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Add New Post</a>

            </div>



            <div class="gs-list">

                @foreach($posts as $index => $post)

                <div class="gs-card"

                     data-status="{{ strtoupper($post['status']) }}"

                     data-date="{{ $post['posted_at'] }}"

                     data-pax="{{ $post['pax'] }}">

                    <div class="gs-index">{{ sprintf('%02d', $index + 1) }}</div>

                    <div class="gs-body">

                        <div style="flex:1">

                            <h3 class="gs-title">{{ $post['title'] }}</h3>

                            <div class="gs-info">

                                <div class="gs-desc">{{ $post['description'] }}</div>

                                <div class="meta-row"><span>📍 {{ $post['pickup_location'] }}</span></div>

                                <div class="meta-row"><span>📅 {{ $post['posted_at'] }}</span></div>

                                <div class="meta-row"><span>👁️ {{ $post['pax'] }}</span></div>

                                <div class="badge-column">

                                    @php

                                        $status = strtoupper($post['status']);

                                        $badgeClass = match($status) {

                                            'ACTIVE' => 'badge-active',

                                            'CLAIMED' => 'badge-claimed',

                                            'COMPLETED' => 'badge-completed',

                                            'EXPIRED' => 'badge-expired',

                                            default => 'badge-active',

                                        };

                                    @endphp

                                    <div class="gs-badge {{ $badgeClass }}">{{ $status }}</div>

                                    <a class="see-btn" href="{{ $post['details_link'] }}" target="_blank">See Details</a>

                                </div>

                            </div>

                        </div>

                        <div class="img-col">

                            <img src="{{ $post['image_url'] }}" alt="{{ $post['title'] }}">

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </main>



    <footer id="footer" class="custom-red-footer">

        <div class="container text-center">

            <p>© ShareAMeal - All Rights Reserved</p>

        </div>

    </footer>

    <script src="{{ asset('assets/js/myposts.js') }}"></script>

</body>

</html>



