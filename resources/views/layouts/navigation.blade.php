<header class="main-navbar bg-white shadow-sm py-2 px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!-- الشعار -->
        <div class="logo d-flex align-items-center gap-2">
            <img src="{{asset('images/logo.png')}}" alt="" class="logo-img">
            <span class="fw-bold fs-5 text-fuchsia logo-text">فستان ريهام</span>
        </div>

        <!-- أيقونة القائمة للموبايل -->
        <div class="d-lg-none d-flex align-items-center gap-2">
            @auth
                <a href="{{ route('cart.index') }}" class="btn btn-cart-mobile me-1" title="سلة المشتريات">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            @endauth
            <button type="button" class="navbar-burger" id="navbarToggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        
        

        <!-- الروابط للديسكتوب -->
        <nav class="main-nav flex-grow-1 d-none d-lg-block">
            <ul class="d-flex align-items-center gap-4 mb-0 justify-content-center main-nav-list">
                <li><a href="{{ url('/') }}" class="nav-link">الرئيسية</a></li>
                <li><a href="{{ route('shop') }}" class="nav-link">المنتجات</a></li>
                <li><a href="#about" class="nav-link">عن المتجر</a></li>
                <li><a href="#contact" class="nav-link">اتصل بنا</a></li>
                @auth
                    @if(Auth::user()->isAdmin || Auth::user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="nav-link fw-bold text-fuchsia">لوحة التحكم</a></li>
                    @endif
                @endauth
            </ul>
        </nav>

        <!-- الأزرار للديسكتوب -->
        <div class="auth-buttons d-none d-lg-flex align-items-center gap-2 flex-shrink-0">
            @auth
                <a href="{{ route('cart.index') }}" class="btn btn-cart position-relative" title="سلة المشتريات">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            @endauth
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

    <!-- القائمة المنسدلة للموبايل والتابلت -->
    <div class="mobile-dropdown" id="mobileDropdown">
        <div class="dropdown-content">
            <div class="nav-section">
                <a href="{{ url('/') }}" class="dropdown-link">
                    <span class="link-icon">🏠</span>
                    الرئيسية
                </a>
                <a href="{{ url('/products') }}" class="dropdown-link">
                    <span class="link-icon">👗</span>
                    المنتجات
                </a>
                <a href="{{ url('/about') }}" class="dropdown-link">
                    <span class="link-icon">ℹ️</span>
                    عن المتجر
                </a>
                <a href="{{ url('/contact') }}" class="dropdown-link">
                    <span class="link-icon">📞</span>
                    اتصل بنا
                </a>
                @auth
                    @if(Auth::user()->isAdmin || Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-link admin-link">
                        <span class="link-icon">⚙️</span>
                        لوحة التحكم
                    </a>
                    @endif
                @endauth
            </div>

            <div class="auth-section">
                
                @guest
                    <a href="{{ route('login') }}" class="dropdown-btn btn-login">تسجيل دخول</a>
                    <a href="{{ route('register') }}" class="dropdown-btn btn-register">حساب جديد</a>
                @else
                    <a href="{{ route('profile.edit') }}" class="dropdown-btn btn-profile">الملف الشخصي</a>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="dropdown-btn btn-logout">تسجيل الخروج</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</header>

<style>
:root {
    --fuchsia: #ec4899;
    --fuchsia-dark: #db2777;
    --fuchsia-light: #fce7f3;
    --gray-600: #4b5563;
    --gray-200: #e5e7eb;
    --gray-50: #f9fafb;
    --shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.text-fuchsia {
    color: var(--fuchsia) !important;
}

.main-navbar {
    position: sticky;
    top: 0;
    z-index: 1050;
    background-color: #fff;
    border-bottom: 1px solid var(--gray-200);
    font-family: 'Cairo', sans-serif;
}

/* Logo Styles */
.logo {
    flex-shrink: 0;
}

.logo-img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.logo-text {
    font-family: 'Cairo', sans-serif;
    font-size: 1.25rem;
    white-space: nowrap;
}

/* Desktop Navigation */
.main-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.main-nav .nav-link {
    color: var(--gray-600);
    font-weight: 500;
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
    padding: 0.75rem 0.5rem;
    white-space: nowrap;
    display: block;
}

.main-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
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

.main-nav .nav-link:hover::after,
.main-nav .nav-link.active::after {
    width: 100%;
    left: 0;
}

/* Auth Buttons */
.btn-login,
.btn-register,
.btn-logout,
.btn-profile {
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    white-space: nowrap;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-login {
    background: var(--fuchsia);
    color: #fff;
}
.btn-login:hover {
    background: var(--fuchsia-dark);
    color: #fff;
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
    background: var(--gray-50);
    color: var(--fuchsia-dark);
    border: 1px solid var(--fuchsia);
}
.btn-logout:hover {
    background: var(--fuchsia-light);
}

.btn-profile {
    background: #fff;
    color: var(--gray-600);
    border: 2px solid var(--gray-200);
}
.btn-profile:hover {
    background: var(--gray-50);
    color: var(--gray-600);
}

/* Cart Button */
.btn-cart {
    background: #fff;
    color: var(--fuchsia);
    border: 2px solid var(--fuchsia);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.2s;
    margin-left: 0.25rem;
}
.btn-cart:hover, .btn-cart:focus {
    background: var(--fuchsia-light);
    color: var(--fuchsia-dark);
    border-color: var(--fuchsia-dark);
}

@media (max-width: 991px) {
    .btn-cart {
        width: 38px;
        height: 38px;
        font-size: 1.1rem;
        margin: 0 0.25rem 0 0;
    }
}
@media (max-width: 767px) {
    .btn-cart {
        width: 36px;
        height: 36px;
        font-size: 1rem;
        margin: 0 0.15rem 0 0;
    }
}

/* Cart Button Mobile */
.btn-cart-mobile {
    background: #fff;
    color: var(--fuchsia);
    border-radius: 50%;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.2s;
    margin-left: 0.25rem;
}
.btn-cart-mobile:hover, .btn-cart-mobile:focus {
    background: var(--fuchsia-light);
    color: var(--fuchsia-dark);
  
}
@media (min-width: 992px) {
    .btn-cart-mobile {
        display: none !important;
    }
}

/* Burger Menu */
.navbar-burger {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    width: 32px;
    height: 32px;
    justify-content: center;
    gap: 4px;
    background: none;
    border: none;
    padding: 0;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1051;
}

.navbar-burger span {
    display: block;
    height: 3px;
    background: var(--fuchsia);
    border-radius: 2px;
    width: 100%;
    transition: all 0.3s ease;
    transform-origin: center;
}

.navbar-burger.active span:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

.navbar-burger.active span:nth-child(2) {
    opacity: 0;
}

.navbar-burger.active span:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
}

/* Mobile Dropdown */
.mobile-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    box-shadow: var(--shadow);
    z-index: 1040;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    border-top: 1px solid var(--gray-200);
}

.mobile-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    min-height: auto;
}

.nav-section {
    padding: 1.5rem 1rem;
    border-left: 1px solid var(--gray-200);
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.auth-section {
    padding: 1.5rem 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    background: var(--gray-50);
    justify-content: center;
}

.dropdown-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: var(--gray-600);
    text-decoration: none;
    font-weight: 500;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    margin: 0.125rem 0;
}

.dropdown-link:hover {
    background: var(--fuchsia-light);
    color: var(--fuchsia-dark);
    transform: translateX(5px);
}

.dropdown-link.admin-link {
    color: var(--fuchsia);
    font-weight: 600;
}

.dropdown-link.admin-link:hover {
    background: var(--fuchsia);
    color: #fff;
}

.link-icon {
    font-size: 1.1rem;
    width: 24px;
    text-align: center;
}

.dropdown-btn {
    width: 100%;
    text-align: center;
    padding: 0.75rem;
    font-size: 0.9rem;
}

.logout-form {
    margin: 0;
}

/* Tablet Styles */
@media (max-width: 991px) and (min-width: 768px) {
    .logo-text {
        font-size: 1.1rem;
    }
    
    .navbar-burger {
        width: 28px;
        height: 28px;
    }
    
    .dropdown-content {
        grid-template-columns: 1fr 1fr;
    }
    
    .nav-section {
        padding: 1.25rem;
    }
    
    .auth-section {
        padding: 1.25rem;
    }
}

/* Mobile Styles */
@media (max-width: 767px) {
    .main-navbar {
        padding: 0.75rem 1rem;
    }
    
    .logo-img {
        width: 35px;
        height: 35px;
    }
    
    .logo-text {
        font-size: 1rem;
    }
    
    .navbar-burger {
        width: 26px;
        height: 26px;
        gap: 3px;
    }
    
    .navbar-burger span {
        height: 2.5px;
    }
    
    .dropdown-content {
        grid-template-columns: 1fr;
    }
    
    .nav-section {
        padding: 1rem;
        border-left: none;
        border-bottom: 1px solid var(--gray-200);
    }
    
    .auth-section {
        padding: 1rem;
    }
    
    .dropdown-link {
        padding: 0.625rem 0.75rem;
        font-size: 0.95rem;
    }
    
    .dropdown-btn {
        padding: 0.625rem;
        font-size: 0.875rem;
    }
}

/* Extra Small Screens */
@media (max-width: 480px) {
    .main-navbar {
        padding: 0.5rem 0.75rem;
    }
    
    .logo-img {
        width: 30px;
        height: 30px;
    }
    
    .logo-text {
        font-size: 0.9rem;
    }
    
    .dropdown-link {
        padding: 0.5rem;
        font-size: 0.9rem;
        gap: 0.5rem;
    }
    
    .link-icon {
        font-size: 1rem;
        width: 20px;
    }
    
    .nav-section,
    .auth-section {
        padding: 0.75rem;
    }
    
    .dropdown-btn {
        padding: 0.5rem;
        font-size: 0.8rem;
    }
}

/* Focus states for accessibility */
.navbar-burger:focus,
.dropdown-link:focus,
.dropdown-btn:focus {
    outline: 2px solid var(--fuchsia);
    outline-offset: 2px;
}

/* Prevent body scroll when menu is open */
body.menu-open {
    overflow: hidden;
}

/* Animation improvements */
.dropdown-link {
    transform: translateX(0);
}

.dropdown-link:hover {
    transform: translateX(5px);
}

/* RTL Support */
[dir="rtl"] .dropdown-link:hover {
    transform: translateX(-5px);
}

[dir="rtl"] .nav-section {
    border-left: none;
    border-right: 1px solid var(--gray-200);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbarToggle = document.getElementById('navbarToggle');
    const mobileDropdown = document.getElementById('mobileDropdown');
    
    // Toggle mobile dropdown
    navbarToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        navbarToggle.classList.toggle('active');
        mobileDropdown.classList.toggle('show');
        
        // Prevent body scroll when menu is open
        if (mobileDropdown.classList.contains('show')) {
            document.body.classList.add('menu-open');
        } else {
            document.body.classList.remove('menu-open');
        }
    });
    
    // Close dropdown when clicking on a link
    document.querySelectorAll('.dropdown-link').forEach(link => {
        link.addEventListener('click', function() {
            closeDropdown();
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const navbar = document.querySelector('.main-navbar');
        if (!navbar.contains(e.target) && mobileDropdown.classList.contains('show')) {
            closeDropdown();
        }
    });
    
    // Close dropdown on window resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            closeDropdown();
        }
    });
    
    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileDropdown.classList.contains('show')) {
            closeDropdown();
        }
    });
    
    // Function to close dropdown
    function closeDropdown() {
        navbarToggle.classList.remove('active');
        mobileDropdown.classList.remove('show');
        document.body.classList.remove('menu-open');
    }

});
</script>