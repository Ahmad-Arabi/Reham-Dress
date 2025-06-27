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

<!-- Products from Database --> 
<section class="products-preview" id="products">     
    <h2 class="section-title">منتجاتنا</h2>     
    <div class="products-grid">         
        @forelse($featuredProducts as $product)
            <div class="product-card">             
                <div class="product-image">
                    @if($product->main_image && $product->main_image !== '/images/placeholder.jpg')
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" loading="lazy">
                    @else
                        <div class="product-placeholder">
                            @if(str_contains(strtolower($product->name), 'فستان') || str_contains(strtolower($product->name), 'بنات'))
                                👗
                            @elseif(str_contains(strtolower($product->name), 'قميص') || str_contains(strtolower($product->name), 'أولاد'))
                                👕
                            @elseif(str_contains(strtolower($product->name), 'شتوي') || str_contains(strtolower($product->name), 'جاكيت'))
                                🧥
                            @else
                                👶
                            @endif
                        </div>
                    @endif
                </div>             
                <div class="product-info">                 
                    <h3>{{ $product->name }}</h3>                 
                    <p>{{ Str::limit($product->description, 60) }}</p>
                    
                    @if($product->colors->count() > 0)
                        <div class="product-colors">
                            <small>الألوان المتاحة: 
                                @foreach($product->colors->take(3) as $color)
                                    <span class="color-tag">{{ $color->color }}</span>
                                @endforeach
                                @if($product->colors->count() > 3)
                                    <span class="more-colors">+{{ $product->colors->count() - 3 }}</span>
                                @endif
                            </small>
                        </div>
                    @endif

                    @if($product->sizes->count() > 0)
                        <div class="product-sizes">
                            <small>الأعمار المتاحة: 
                                @foreach($product->sizes->take(3) as $size)
                                    <span class="size-tag">{{ $size->age }}</span>
                                @endforeach
                                @if($product->sizes->count() > 3)
                                    <span class="more-sizes">+{{ $product->sizes->count() - 3 }}</span>
                                @endif
                            </small>
                        </div>
                    @endif
                    
                    <div class="product-footer">
                        <div class="product-price">{{ $product->formatted_price }}</div>
                        @if($product->is_in_stock)
                            <span class="stock-status in-stock">متوفر</span>
                        @else
                            <span class="stock-status out-of-stock">غير متوفر</span>
                        @endif
                    </div>
                </div>         
            </div>
        @empty
            <!-- Fallback content when no products exist -->
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
        @endforelse     
    </div>
    
    @if($featuredProducts->count() > 0)
        <div class="products-footer">
            <a href=""class="btn-primary py-1 px-2">عرض جميع المنتجات</a>
        </div>
    @endif
</section> 

@endsection

@push('styles')
<style>
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
</style>
@endpush