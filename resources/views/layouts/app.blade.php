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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    @vite(['resources/css/test.css'])
    @stack('styles')
    @include('partials.order-status-icons')
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body>

    {{-- Design and responsive --}}
    {{-- Auth / cart icon to direct the user to the cart --}}
    @include('layouts.navigation')


    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-grid">
            <div class="footer-section">
                <h4>ريهام دريس</h4>
                <p>متجر متخصص في ملابس الأطفال العصرية والأنيقة.</p>
            </div>
            <div class="footer-section">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="#home">الرئيسية</a></li>
                    <li><a href="#products">المنتجات</a></li>
                    <li><a href="#about">عن المتجر</a></li>
                    <li><a href="#contact">اتصل بنا</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>تواصل معنا</h4>
                <ul>
                    <li><i class="fas fa-phone"></i> +966 123 456 789</li>
                    <li><i class="fas fa-envelope"></i> info@rehamdress.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> الرياض، السعودية</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 ريهام دريس. جميع الحقوق محفوظة.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        function toggleMenu() {
            document.getElementById('nav-menu').classList.toggle('active');
            document.getElementById('auth-buttons').classList.toggle('active');
        }
    </script>
    @stack('scripts')
</body>

</html>
