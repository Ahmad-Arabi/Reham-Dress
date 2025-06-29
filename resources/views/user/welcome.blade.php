@extends('layouts.app') 
@section('page_title', 'الرئيسية')
@section('content')      
<section class="hero" id="home">     
    <div class="hero-text">         
        <h1>ملابس أطفال عصرية وأنيقة</h1>         
        <p>اكتشف مجموعتنا الواسعة من ملابس الأطفال ذات التصاميم العصرية والمريحة، بأفضل جودة وخدمة.</p>         
        <div class="hero-buttons">             
            <a href="{{ route('shop') }}" class="btn-primary">تسوق الآن</a>             
     
        </div>     
    </div>     
    <div class="hero-image">
        <img src="{{ asset('images/hero.jpg') }}" 
             alt="ملابس أطفال عصرية وأنيقة" 
             class="hero-img"
             loading="lazy">
    </div> 
</section>  

<!-- Features --> 
<section class="features" id="about">     
    <h2 class="section-title">لماذا تختار فستان ريهام؟</h2>     
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

<!-- Products from Database --> 
<section class="products-preview" id="products">     
    <h2 class="section-title">أحدث المنتجات</h2>     
    <div class="products-grid">
        @forelse($featuredProducts as $product)
            <div class="product-card">
                @if ($product->thumbnail)
                    <img src="{{ asset('storage/products/thumbnails/' . $product->id . '/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-100" style="height:220px;object-fit:cover;">
                @else
                    <img src="{{ asset('images/fallback.jpg') }}" alt="{{ $product->name }}" class="w-100" style="height:220px;object-fit:cover;">
                @endif
                <div class="p-3">
                    <h4 class="mb-2">{{ $product->name }}</h4>
                    <div class="mb-2 text-admin-pink fw-bold">{{ $product->price }} د.أ</div>
                    <a href="{{ route('product', $product->id) }}" class="btn btn-admin-pink w-100 py-1">عرض التفاصيل</a>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center w-100">لا توجد منتجات متاحة حالياً.</div>
        @endforelse
    </div>
    @if($featuredProducts->count() > 0)
        <div class="products-footer">
            <a href="{{route('shop')}}" class="btn btn-admin-pink py-1 px-2">عرض جميع المنتجات</a>
        </div>
    @endif
</section> 

@endsection

@push('styles')
<style>
/* Global styles to prevent horizontal scroll */
* {
    box-sizing: border-box;
}

body {
    overflow-x: hidden;
    max-width: 100vw;
}

.container, .hero, .features, .products-preview {
    max-width: 100%;
    overflow-x: hidden;
}

/* Hero Section Styles */
.hero {
    display: flex;
    align-items: center;
    justify-content: space-evenly; 
    min-height: 80vh;
    padding: 2rem 1rem;
    gap: 2rem;
    max-width: 100%;
    overflow: hidden;
    box-sizing: border-box;
}

.hero-text {
    flex: 1;
    max-width: 600px;
    min-width: 0;
    box-sizing: border-box;
}

.hero-image {
    flex: 0 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    max-width: 450px;

}

.hero-img {
    width: 450px;
    height: 450px;
    border-radius: 50%;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 4px solid #fff;
}

.hero-img:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

/* Responsive Design */
@media (max-width: 992px) {
    .hero {
        flex-direction: column;
        text-align: center;
        min-height: auto;
        gap: 2rem;
        padding: 1rem;
    }
    
    .hero-text {
        order: 2;
        max-width: 100%;
    }
    
    .hero-image {
        order: 1;
        width: 100%;
        max-width: 320px;
    }
    
    .hero-img {
        width: 280px;
        height: 280px;
        border-radius: 50%;
    }
}

@media (max-width: 480px) {
    .hero {
        padding: 1rem 0.5rem;
        gap: 1.5rem;
    }
    
    .hero-image {
        max-width: 240px;
    }
    
    .hero-img {
        width: 220px;
        height: 220px;
        border-radius: 50%;
    }
}

/* Product Section Styles */
.product-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.product-placeholder {
    width: 100%;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.product-colors, .product-sizes {
    margin: 8px 0;
}

.color-tag, .size-tag {
    display: inline-block;
    background: #e3f2fd;
    color: #1976d2;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    margin: 0 4px 4px 0;
}

.more-colors, .more-sizes {
    color: #666;
    font-size: 0.75rem;
}

.product-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 12px;
}

.stock-status {
    font-size: 0.75rem;
    padding: 4px 8px;
    border-radius: 8px;
    font-weight: bold;
}

.stock-status.in-stock {
    background: #e8f5e8;
    color: #2e7d32;
}

.stock-status.out-of-stock {
    background: #ffebee;
    color: #c62828;
}

.products-footer {
    text-align: center;
    margin-top: 3rem;
}

/* Additional Hero Enhancements */
.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(244, 245, 247, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    pointer-events: none;
    z-index: -1;
}

/* Optional: Add decorative elements */
.hero-image::after {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    border-radius: 50%;
    opacity: 0.1;
    z-index: -1;
}

.hero-image::before {
    content: '';
    position: absolute;
    bottom: -20px;
    left: -20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, #a8e6cf, #dcedc1);
    border-radius: 50%;
    opacity: 0.15;
    z-index: -1;
}

.products-grid{
    background-color: inherit;
}

.btn-admin-pink {
    background: linear-gradient(45deg, #ec4899, #a855f7) !important;
    color: #fff !important;
    border: none;
    border-radius: 999px;
    font-weight: bold;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(236, 72, 153, 0.08);
}
.btn-admin-pink:hover, .btn-admin-pink:focus {
    background: linear-gradient(45deg, #db2777, #9333ea) !important;
    color: #fff !important;
    box-shadow: 0 4px 16px rgba(236, 72, 153, 0.13);
}
</style>
@endpush