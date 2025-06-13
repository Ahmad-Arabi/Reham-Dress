@extends('layouts.app')

@section('content')
<div class="main-background">
    <div class="main-content">
        

        <section class="hero-section">
            <div class="hero-content">
                <h2>مجموعة الصيف الجديدة</h2>
                <p>أناقة لا مثيل لها لكل مناسبة. اكتشفوا الآن!</p>
                <a href="" class="shop-now-btn">تسوقوا الآن</a>
            </div>
        </section>

        <section class="products-grid">
            <div class="container">
                <h3>منتجات مميزة</h3>
                <div class="grid-container">
                    {{-- Example Product Card (replace with dynamic loop) --}}
                    @if(isset($newArrivals) && count($newArrivals) > 0)
                        @foreach($newArrivals as $product)
                            <div class="product-card">
                                <img src="{{ asset($product->image) ?? asset('images/placeholder.jpg') }}" alt="{{ $product->name ?? 'Product' }}">
                                <h4>{{ $product->name ?? 'Product Name' }}</h4>
                                <p class="price">{{ $product->price ?? '0.00' }} د.أ</p>
                                <button class="add-to-cart-btn">أضف للسلة</button>
                            </div>
                        @endforeach
                    @else
                         {{-- Fallback or message if no products --}}
                         <p>لا توجد منتجات مميزة حالياً.</p>
                    @endif
                </div>
                <a href="" class="btn view-all-btn">عرض كل المنتجات</a>
            </div>
        </section>

        {{-- Featured Collections (replace with dynamic loop if needed) --}}
         <section class="featured-collections">
            <div class="container">
                <h3>مجموعاتنا الخاصة</h3>
                <div class="collection-items">
                     {{-- Example Collection Card (replace with dynamic loop) --}}
                    <div class="collection-card">
                        <img src="" alt="Collection 1">
                        <h4>مجموعاتنا الخاصة</h4>
                        <a href="#" class="btn-small">اكتشفوا</a>
                    </div>
                     <div class="collection-card">
                        <img src="" alt="Collection 2">
                        <h4>مجموعات جديدة</h4>
                        <a href="#" class="btn-small">اكتشفوا</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="newsletter-cta">
            <div class="container">
                <h3>اشترك في نشرتنا الإخبارية</h3>
                <p>كن أول من يعرف عن أحدث العروض والمجموعات.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="أدخل بريدك الإلكتروني" required>
                    <button type="submit" class="btn">اشترك</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection 