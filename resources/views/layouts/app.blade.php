<!DOCTYPE html>
<html lang="ar " dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>فستان ريهام | @yield('page_title')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
     @stack('styles')
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>

    <header class="main-navbar">
            <div class="container">
                <h1 class="logo"><a href="">Reham Dress</a></h1>
                <nav>
                    <ul class="nav-links">
                        <li><a href="">الرئيسية</a></li>
                        <li><a href="#">المجموعات الجديدة</a></li>
                        <li class="dropdown">
                            <a href="#">الفساتين <i class="fas fa-caret-down"></i></a>
                            <div class="dropdown-content">
                                <a href="#">فساتين سهرة</a>
                                <a href="#">فساتين يومية</a>
                                <a href="#">فساتين صيفية</a>
                            </div>
                        </li>
                        <li><a href="#">البلايز</a></li>
                        <li><a href="#">التخفيضات</a></li>
                        <li><a href="">اتصل بنا</a></li>
                    </ul>
                    <div class="nav-icons">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        <a href="#"><i class="fas fa-search"></i></a>
                        <a href=""><i class="fas fa-shopping-cart"></i></a>
                        @auth
                            <a href=""><i class="fas fa-user"></i></a>
                        @else
                            <a href=""><i class="fas fa-user"></i></a>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>
   
    
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-columns">
                <div class="footer-col">
                    <h4>عن ريهام دريس</h4>
                    <p>متجركم الأول للأزياء العصرية والراقية، نسعى لتقديم الأفضل دائماً.</p>
                </div>
                <div class="footer-col">
                    <h4>روابط سريعة</h4>
                    <ul>
                        <li><a href="">من نحن</a></li>
                        <li><a href="#">سياسة الخصوصية</a></li>
                        <li><a href="#">شروط الاستخدام</a></li>
                        <li><a href="#">الأسئلة الشائعة</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>تواصل معنا</h4>
                    <ul>
                        <li><i class="fas fa-envelope"></i> info@rehamdress.com</li>
                         {{-- Replace with actual phone and address if available --}}
                        <li><i class="fas fa-phone"></i> +966 XX XXX XXXX</li>
                        <li><i class="fas fa-map-marker-alt"></i> موقع المتجر (إذا توفر)</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>تابعنا على</h4>
                    <div class="social-icons">
                         {{-- Replace # with actual social media links --}}
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} ريهام دريس. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 @stack('scripts')
</body>
</html> 