<header class="main-navbar bg-white shadow-sm py-2 px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <div class="logo d-flex align-items-center gap-2">
            <i class="fas fa-tshirt fa-lg text-admin-pink"></i>
            <span class="fw-bold fs-5 text-admin-pink">ريهام دريس</span>
        </div>
        <input type="checkbox" id="navbar-toggle" class="d-none">
        <label for="navbar-toggle" class="navbar-burger d-lg-none ms-2">
            <span></span><span></span><span></span>
        </label>
        <nav class="main-nav flex-grow-1">
            <ul class="d-flex align-items-center gap-4 mb-0 flex-wrap justify-content-center main-nav-list">
                <li><a href="{{ url('/') }}" class="nav-link">الرئيسية</a></li>
                <li><a href="{{ url('/products') }}" class="nav-link">المنتجات</a></li>
                <li><a href="{{ url('/about') }}" class="nav-link">عن المتجر</a></li>
                <li><a href="{{ url('/contact') }}" class="nav-link">اتصل بنا</a></li>
                @auth
                    @if(Auth::user()->isAdmin || Auth::user()->role === 'admin')
                        <li><a href="" class="nav-link text-admin-pink fw-bold">لوحة التحكم</a></li>
                    @endif
                @endauth
            </ul>
        </nav>
        <div class="auth-buttons d-flex align-items-center gap-2 flex-shrink-0">
            @guest
                <a href="{{ route('login') }}" class="btn btn-login">تسجيل دخول</a>
                <a href="{{ route('register') }}" class="btn btn-register">حساب جديد</a>
            @else
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">الملف الشخصي</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">تسجيل الخروج</button>
                </form>
            @endguest
        </div>
    </div>
</header>

<style>
.main-navbar {
    position: sticky;
    top: 0;
    z-index: 1050;
}
.logo span { font-family: 'Cairo', sans-serif; }
.main-nav ul { list-style: none; padding: 0; }
.main-nav .nav-link {
    color: #22223b;
    font-weight: 500;
    transition: color 0.2s;
    text-decoration: none;
}
.main-nav .nav-link:hover, .main-nav .nav-link.active {
    color: var(--admin-pink);
}
.btn-login, .btn-register {
    border-radius: 0.5rem;
    padding: 0.4rem 1.1rem;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
}
.btn-login { background: var(--admin-pink); color: #fff; border: none; }
.btn-login:hover { background: var(--admin-pink-dark); color: #fff; }
.btn-register { background: #fff; color: var(--admin-pink); border: 2px solid var(--admin-pink); }
.btn-register:hover { background: var(--admin-pink-light); color: var(--admin-pink-dark); }

/* Burger menu for mobile */
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
    height: 4px;
    background: var(--admin-pink);
    border-radius: 2px;
    width: 100%;
    transition: 0.3s;
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
    box-shadow: 0 2px 8px 0 rgba(236,72,153,0.07);
}
@media (max-width: 991px) {
    .main-nav .main-nav-list {
        display: none;
    }
    #navbar-toggle:checked ~ .main-nav .main-nav-list {
        display: flex !important;
    }
    .auth-buttons { margin-top: 1rem; }
}
</style>
