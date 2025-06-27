@extends('layouts.app')

@section('page_title', 'تسوق')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">تسوق منتجاتنا</h1>
    <div class="products-grid">
        <div class="grid-container">
            {{-- مثال على عرض المنتجات. يمكنك ربطها بالداتا من الكنترولر لاحقاً --}}
            <div class="product-card">
                <img src="{{ asset('images/1.jpeg') }}" alt="منتج 1">
                <h4>فستان بناتي وردي</h4>
                <div class="price">120 ر.س</div>
                <a href="#" class="add-to-cart-btn">أضف إلى السلة</a>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/2.jpeg') }}" alt="منتج 2">
                <h4>فستان بناتي أزرق</h4>
                <div class="price">135 ر.س</div>
                <a href="#" class="add-to-cart-btn">أضف إلى السلة</a>
            </div>
            <div class="product-card">
                <img src="{{ asset('images/6136866.jpg') }}" alt="منتج 3">
                <h4>فستان بناتي أبيض</h4>
                <div class="price">150 ر.س</div>
                <a href="#" class="add-to-cart-btn">أضف إلى السلة</a>
            </div>
            {{-- أضف المزيد من المنتجات حسب الحاجة --}}
        </div>
    </div>
</div>
@endsection 