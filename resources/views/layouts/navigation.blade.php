<header class="main-navbar bg-white shadow-sm py-2 px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- الشعار -->
        <div class="logo d-flex align-items-center gap-2">
            <img src="{{asset('images/logo.png')}}" alt="" class="w-25">
            <span class="fw-bold fs-5 text-fuchsia"> فستان ريهام</span>
        </div>

        <!-- أيقونة القائمة للموبايل -->
        <input type="checkbox" id="navbar-toggle" class="d-none">
        <label for="navbar-toggle" class="navbar-burger d-lg-none ms-2">
            <span></span><span></span><span></span>
        </label>

        <!-- الروابط -->
        <nav class="main-nav flex-grow-1">
            <ul class="d-flex align-items-center gap-4 mb-0 flex-wrap justify-content-center main-nav-list">
                <li><a href="{{ url('/') }}" class="nav-link">الرئيسية</a></li>
                <li><a href="{{ url('/products') }}" class="nav-link">المنتجات</a></li>
                <li><a href="{{ url('/about') }}" class="nav-link">عن المتجر</a></li>
                <li><a href="{{ url('/contact') }}" class="nav-link">اتصل بنا</a></li>
                @auth
                    @if(Auth::user()->isAdmin || Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="nav-link fw-bold text-fuchsia">لوحة التحكم</a></li>
                    @endif
                @endauth
            </ul>
        </nav>

        <!-- الأزرار -->
        <div class="auth-buttons d-flex align-items-center gap-2 flex-shrink-0">
            @guest
                <a href="{{ route('login') }}" class="btn btn-login">تسجيل دخول</a>
                <a href="{{ route('register') }}" class="btn btn-register">حساب جديد</a>
            @else
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">الملف الشخصي</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">تسجيل الخروج</button>
                </form>
            @endguest
        </div>
    </div>
</header>

<style>
:root {
    --fuchsia: #ec4899;
    --fuchsia-dark: #db2777;
    --fuchsia-light: #fce7f3;
}

.text-fuchsia {
    color: var(--fuchsia) !important;
}

.main-navbar {
    position: sticky;
    top: 0;
    z-index: 1050;
    background-color: #fff;
    border-bottom: 1px solid #f3f4f6;
}

.logo span {
    font-family: 'Cairo', sans-serif;
    font-size: 1.25rem;
}

.main-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.main-nav .nav-link {
    color: #374151;
    font-weight: 500;
    text-decoration: none;
    position: relative;
    transition: 0.25s;
}

.main-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: -4px;
    right: 0;
    height: 2px;
    width: 0%;
    background-color: var(--fuchsia);
    transition: width 0.3s ease;
}

.main-nav .nav-link:hover,
.main-nav .nav-link.active {
    color: var(--fuchsia);
}

.main-nav .nav-link:hover::after {
    width: 100%;
    left: 0;
}

/* أزرار الدخول والتسجيل */
.btn-login,
.btn-register,
.btn-logout {
    border-radius: 0.5rem;
    padding: 0.4rem 1.1rem;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: 0.3s ease-in-out;
}

.btn-login {
    background: var(--fuchsia);
    color: #fff;
    border: none;
}
.btn-login:hover {
    background: var(--fuchsia-dark);
}

.btn-register {
    background: #fff;
    color: var(--fuchsia);
    border: 2px solid var(--fuchsia);
}
.btn-register:hover {
    background: var(--fuchsia-light);
    color: var(--fuchsia-dark);
}

.btn-logout {
    background: #f9f9f9;
    color: var(--fuchsia-dark);
    border: 1px solid var(--fuchsia);
}
.btn-logout:hover {
    background: var(--fuchsia-light);
}

/* القائمة في الموبايل */
.navbar-burger {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    width: 32px;
    height: 32px;
    justify-content: center;
    gap: 5px;
}
.navbar-burger span {
    display: block;
    height: 3px;
    background: var(--fuchsia);
    border-radius: 2px;
    width: 100%;
    transition: 0.3s ease;
}

#navbar-toggle:checked ~ .main-nav .main-nav-list {
    display: flex !important;
    flex-direction: column;
    gap: 1rem;
    background: #fff;
    position: absolute;
    top: 60px;
    right: 0;
    left: 0;
    z-index: 1049;
    padding: 1.5rem 0;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

@media (max-width: 991px) {
    .main-nav .main-nav-list {
        display: none;
    }

    #navbar-toggle:checked ~ .main-nav .main-nav-list {
        display: flex !important;
    }

    .auth-buttons {
        margin-top: 1rem;
        justify-content: center;
        width: 100%;
    }

    .main-navbar .container-fluid {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>
