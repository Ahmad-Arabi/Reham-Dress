<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - لوحة التحكم</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css'])
    @vite(['resources/css/admin.css'])
    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light" style="font-family: 'Cairo', sans-serif;">
    <div class="container-fluid min-vh-100 d-flex flex-row p-0">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column p-0 border-end" style="width: 260px;">
            <div class="d-flex flex-column flex-shrink-0 bg-white h-100">
                <div class="d-flex align-items-center justify-content-center py-4 border-bottom">
                    <img class="img-fluid" style="height: 40px;" src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
                </div>
                <nav class="nav flex-column px-3 mt-3">
                    <a href="#" class="nav-link mb-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-admin-pink">
                        <i class="bi bi-house me-2 text-admin-pink"></i> الرئيسية
                    </a>
                    <a href="#" class="nav-link mb-2 {{ request()->routeIs('admin.products.*') ? 'active' : '' }} text-admin-pink">
                        <i class="bi bi-box-seam me-2 text-admin-pink"></i> المنتجات
                    </a>
                    <a href="#" class="nav-link mb-2 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }} text-admin-pink">
                        <i class="bi bi-receipt me-2 text-admin-pink"></i> الطلبات
                    </a>
                    <a href="#" class="nav-link mb-2 {{ request()->routeIs('admin.users.*') ? 'active' : '' }} text-admin-pink">
                        <i class="bi bi-people me-2 text-admin-pink"></i> المستخدمين
                    </a>
                    <a href="#" class="nav-link mb-2 {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }} text-admin-pink">
                        <i class="bi bi-tags me-2 text-admin-pink"></i> الكوبونات
                    </a>
                    <a href=" {{ route('admin.coupons.index')}}" class="nav-link mb-2 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }} text-admin-pink">
                        <i class="bi bi-gear me-2 text-admin-pink"></i> الإعدادات
                    </a>
                </nav>
                <div class="mt-auto border-top p-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary w-100">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Main content -->
        <main class="flex-fill">
            <div class="py-4">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>