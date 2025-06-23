<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ريهام دريس - ملابس أطفال</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to bottom, #fce7f3, #f3e8ff);
            color: #333;
            direction: rtl;
        }
        a { text-decoration: none; color: inherit; }

        /* Navbar */
        header {
            background: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.4rem;
            font-weight: bold;
            color: #ec4899;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        nav ul li a {
            color: #374151;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav ul li a:hover {
            color: #ec4899;
        }
        .auth-buttons a {
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
        }
        .auth-buttons .btn-login {
            border: 2px solid #ec4899;
            color: #ec4899;
        }
        .auth-buttons .btn-login:hover {
            background: #ec4899;
            color: white;
        }
        .auth-buttons .btn-register {
            background: #ec4899;
            color: white;
        }
        .auth-buttons .btn-register:hover {
            background: #db2777;
        }

        /* Hero */
        .hero {
            padding: 6rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .hero-text {
            max-width: 500px;
        }
        .hero-text h1 {
            font-size: 3rem;
            background: linear-gradient(45deg, #ec4899, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }
        .hero-text p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #555;
        }
        .hero-buttons a {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            margin-left: 1rem;
            font-weight: bold;
        }
        .btn-primary {
            background: linear-gradient(45deg, #ec4899, #a855f7);
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #db2777, #9333ea);
        }
        .btn-secondary {
            background: white;
            border: 2px solid #ddd;
            color: #374151;
        }
        .btn-secondary:hover {
            background: #f9fafb;
        }
        .hero-image {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, rgba(236, 72, 153, 0.1), rgba(168, 85, 247, 0.1));
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 6rem;
        }

        /* Features */
        .features {
            padding: 5rem 2rem;
            background: white;
        }
        .section-title {
            text-align: center;
            font-size: 2rem;
            color: #a855f7;
            margin-bottom: 3rem;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
        }
        .feature-card {
            background: #fef2f8;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            text-align: center;
        }
        .feature-card i {
            font-size: 2rem;
            color: #ec4899;
            margin-bottom: 1rem;
        }
        .feature-card h3 {
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .feature-card p {
            color: #6b7280;
            font-size: 0.95rem;
        }

        /* Products */
        .products-preview {
            padding: 5rem 2rem;
            background: #fce7f3;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
        }
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
            text-align: center;
        }
        .product-image {
            font-size: 4rem;
            padding: 2rem 0;
            background: #f3e8ff;
        }
        .product-info {
            padding: 1.5rem;
        }
        .product-info h3 {
            font-size: 1.1rem;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .product-info p {
            font-size: 0.95rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }
        .product-price {
            color: #ec4899;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background: #1f2937;
            color: #e5e7eb;
            padding: 3rem 2rem 1rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
        }
        .footer-section h4 {
            color: #ec4899;
            margin-bottom: 1rem;
        }
        .footer-section ul {
            list-style: none;
        }
        .footer-section ul li {
            margin-bottom: 0.5rem;
        }
        .footer-section ul li a {
            color: #e5e7eb;
            font-size: 0.9rem;
        }
        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.85rem;
            border-top: 1px solid #374151;
            padding-top: 1rem;
        }
         .header {
      background: linear-gradient(135deg, #fce7f3 0%, #f3e8ff 50%, #dbeafe 100%);
      padding: 1rem 0;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 2rem;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .logo-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(45deg, #ec4899, #a855f7);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.2rem;
    }

    .logo-text {
      font-size: 1.5rem;
      font-weight: bold;
      background: linear-gradient(45deg, #ec4899, #a855f7);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .menu-toggle {
      display: none;
      font-size: 1.8rem;
      color: #ec4899;
      cursor: pointer;
    }

    .nav-menu {
      display: flex;
      list-style: none;
      gap: 2rem;
    }

    .nav-menu a {
      text-decoration: none;
      color: #374151;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-menu a:hover {
      color: #ec4899;
    }

    .auth-buttons {
      display: flex;
      gap: 1rem;
    }

    .btn-login, .btn-register {
      padding: 0.5rem 1rem;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-login {
      color: #ec4899;
      border: 2px solid #ec4899;
    }

    .btn-login:hover {
      background: #ec4899;
      color: white;
    }

    .btn-register {
      background: linear-gradient(45deg, #ec4899, #a855f7);
      color: white;
      border: none;
    }

    .btn-register:hover {
      background: linear-gradient(45deg, #db2777, #9333ea);
      transform: translateY(-2px);
    }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                flex-direction: column-reverse;
                text-align: center;
            }
            nav ul {
                flex-direction: column;
                gap: 1rem;
            }
        }
        @media (max-width: 768px) {
    .hero {
        flex-direction: column-reverse;
        text-align: center;
        padding: 3rem 1rem;
    }
    .hero-text h1 {
        font-size: 2rem;
    }
    .hero-buttons a {
        display: block;
        width: 100%;
        margin: 0.5rem 0;
    }
    nav ul {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem 0;
    }
    .auth-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
}
  @media (max-width: 768px) {
      .nav-menu,
      .auth-buttons {
        display: none;
        flex-direction: column;
        background-color: #fff;
        position: absolute;
        top: 70px;
        right: 0;
        width: 100%;
        padding: 1rem 2rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        z-index: 999;
      }

      .nav-menu.active,
      .auth-buttons.active {
        display: flex;
      }

      .menu-toggle {
        display: block;
      }
    }

    </style>
</head>
<body>

    <!-- Navbar -->
    <header>
        <div class="logo">
            <i class="fas fa-tshirt"></i>
            <span>ريهام دريس</span>
        </div>
        <nav>
            <ul>
                <li><a href="#home">الرئيسية</a></li>
                <li><a href="#products">المنتجات</a></li>
                <li><a href="#about">عن المتجر</a></li>
                <li><a href="#contact">اتصل بنا</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="#" class="btn-login">تسجيل دخول</a>
            <a href="#" class="btn-register">حساب جديد</a>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero" id="home">
        <div class="hero-text">
            <h1>ملابس أطفال عصرية وأنيقة</h1>
            <p>اكتشف مجموعتنا الواسعة من ملابس الأطفال ذات التصاميم العصرية والمريحة، بأفضل جودة وخدمة.</p>
            <div class="hero-buttons">
                <a href="#products" class="btn-primary">تسوق الآن</a>
                <a href="#about" class="btn-secondary">اعرف المزيد</a>
            </div>
        </div>
        <div class="hero-image">👗</div>
    </section>

    <!-- Features -->
    <section class="features" id="about">
        <h2 class="section-title">لماذا تختار ريهام دريس؟</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-heart"></i>
                <h3>أقمشة عالية الجودة</h3>
                <p>نختار أفضل الأقمشة الطبيعية والمريحة لبشرة الأطفال الحساسة.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-palette"></i>
                <h3>تصاميم عصرية</h3>
                <p>مجموعة متنوعة من التصاميم العصرية والألوان الجذابة لجميع الأعمار.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-shipping-fast"></i>
                <h3>توصيل سريع</h3>
                <p>خدمة توصيل سريعة وآمنة إلى جميع أنحاء المملكة.</p>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="products-preview" id="products">
        <h2 class="section-title">منتجاتنا</h2>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">👗</div>
                <div class="product-info">
                    <h3>فساتين بنات</h3>
                    <p>فساتين أنيقة ومريحة للمناسبات المختلفة</p>
                    <div class="product-price">150 ريال</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">👕</div>
                <div class="product-info">
                    <h3>قمصان أولاد</h3>
                    <p>قمصان عملية وأنيقة للاستخدام اليومي</p>
                    <div class="product-price">80 ريال</div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">🧥</div>
                <div class="product-info">
                    <h3>ملابس شتوية</h3>
                    <p>ملابس دافئة وأنيقة لفصل الشتاء</p>
                    <div class="product-price">200 ريال</div>
                </div>
            </div>
        </div>
    </section>

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
      <script>
    function toggleMenu() {
      document.getElementById('nav-menu').classList.toggle('active');
      document.getElementById('auth-buttons').classList.toggle('active');
    }
  </script>

</body>
</html>
