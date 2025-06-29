@extends('layouts.app')

@section('page_title', 'المتجر')

@section('content')
    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">تسوق منتجاتنا</h1>
        <form method="GET" action="" class="row g-3 mb-4 justify-content-center">
            <div class="col-md-2">
                <select name="color" class="form-select">
                    <option value="">كل الألوان</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color }}" {{ request('color') == $color ? 'selected' : '' }}>
                            {{ $color }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="age" class="form-select">
                    <option value="">كل الأعمار</option>
                    @foreach ($ages as $age)
                        <option value="{{ $age }}" {{ request('age') == $age ? 'selected' : '' }}>
                            {{ $age }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="السعر الأدنى"
                    value="{{ request('min_price') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="السعر الأقصى"
                    value="{{ request('max_price') }}">
            </div>
            <div class="col-md-2">
                <select name="in_stock" class="form-select">
                    <option value="">كل المنتجات</option>
                    <option value="1" {{ request('in_stock') === '1' ? 'selected' : '' }}>متوفر فقط</option>
                    <option value="0" {{ request('in_stock') === '0' ? 'selected' : '' }}>غير متوفر فقط</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">بحث</button>
            </div>
        </form>
        <div class="products-grid">
            <div class="grid-container">
                @forelse($products as $product)
                    <div class="product-card">
                        @if ($product->thumbnail)
                            <img src="{{ asset('storage/products/thumbnails/' . $product->id . '/' . $product->thumbnail) }}"
                                alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/fallback.jpg') }}" alt="{{ $product->name }}">
                        @endif
                        <h4>{{ $product->name }}</h4>
                        <div class="price">{{ $product->price }} د.أ</div>
                        <a href="{{ route('product', $product->id) }}" class="add-to-cart-btn">عرض التفاصيل</a>
                    </div>
                @empty
                    <div class="alert alert-warning text-center w-100">لا توجد منتجات متاحة حالياً.</div>
                @endforelse
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links() }}
        </div>
    </div>
    @push('styles')
        <style>
            body {
                background: #f9fafb;
            }

            .products-grid {
                background-color: #f9fafb;
            }
        </style>
    @endpush
@endsection
