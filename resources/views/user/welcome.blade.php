@extends('layouts.app')
@section('page_title', 'الرئيسية')
@section('content')
    
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

{{-- Pull last 3 producdts data from Product Model using a controller --}}
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
@endsection