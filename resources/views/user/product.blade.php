@extends('layouts.app')

@section('page_title', 'تفاصيل المنتج')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-3 fs-5 rounded-3 ">
            <li class="breadcrumb-item"><a href="/" class="text-admin-pink fw-semibold">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}" class="text-admin-pink fw-semibold">المتجر</a></li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
</div>
<div class="container mt-5 mb-5 product-section">
    @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 fw-bold" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 fw-bold" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0 fw-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
    <div class="row justify-content-center product-container">
        <div class="col-md-6">
            <div class="product-card  rounded-4 p-4 position-relative" style="max-width:100%">
                @if($product->images && count($product->images))
                    <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3" style="max-height:350px;">
                            @foreach($product->images as $img)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img src="{{ asset('storage/' . $img->path) }}" alt="{{ $product->name }}" class="d-block w-100" style="object-fit:cover; max-height:350px;">
                                </div>
                            @endforeach
                        </div>
                        @if(count($product->images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">السابق</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">التالي</span>
                        </button>
                        @endif
                    </div>
                @elseif ($product->thumbnail)
                    <img src="{{ asset('storage/products/thumbnails/' . $product->id . '/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-100 mb-4 rounded-3 shadow-sm" style="height:350px;object-fit:cover;">
                @else
                    <img src="{{ asset('images/fallback.jpg') }}" alt="{{ $product->name }}" class="w-100 mb-4 rounded-3 shadow-sm" style="max-height:350px;object-fit:cover;">
                @endif
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <div class=" p-4 h-100 d-flex flex-column justify-content-center">
                <h2 class="mb-3 text-admin-pink fw-bold">{{ $product->name }}</h2>
                <div class="price mb-3 fs-4 fw-semibold text-admin-pink">{{ $product->price }} د.أ</div>
                <p class="mb-4 text-muted">{{ $product->description }}</p>
                @if($product->colors && count($product->colors))
                    <div class="mb-3">
                        <strong>الألوان المتوفرة:</strong>
                        @foreach($product->colors as $color)
                            <span class="d-inline-flex align-items-center gap-1 me-2">
                                <span style="display:inline-block;width:22px;height:22px;background:{{ $color->color }};border-radius:50%;border:2px solid #fff;box-shadow:0 0 0 1px #ccc;"></span>
                                <span class="small text-dark">{{ $color->color }}</span>
                            </span>
                        @endforeach
                    </div>
                @endif
                @if($product->sizes && count($product->sizes))
                    <div class="mb-3">
                        <strong>المقاسات المتوفرة:</strong>
                        @foreach($product->sizes as $size)
                            <span class="badge bg-primary text-white mx-1 px-3 py-2 fs-6" style="background:#e91e63 !important;">{{ $size->age }}</span>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('cart.add') }}" method="POST" class="mb-0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">الكمية:</label>
                        <div class="position-relative d-inline-block" style="width: 70px;">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control form-control-lg rounded-pill border-admin-pink text-center" style="width: 100%; min-width: 60px;">
                        </div>
                    </div>
                    @if($product->colors && count($product->colors))
                        <div class="mb-3">
                            <label for="color" class="form-label fw-semibold">اختر اللون:</label>
                            <div class="position-relative d-inline-block" style="width: 160px;">
                                <select name="color" id="color" class="form-select rounded-pill border-admin-pink w-100">
                                    @foreach($product->colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color }}</option>
                                    @endforeach
                                </select>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="pointer-events:none;">
                                    <i class="fa fa-chevron-down text-muted"></i>
                                </span>
                            </div>
                        </div>
                    @endif
                    @if($product->sizes && count($product->sizes))
                        <div class="mb-3">
                            <label for="size" class="form-label fw-semibold">اختر المقاس:</label>
                            <div class="position-relative d-inline-block" style="width: 160px;">
                                <select name="size" id="size" class="form-select rounded-pill border-admin-pink w-100">
                                    @foreach($product->sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->age }}</option>
                                    @endforeach
                                </select>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="pointer-events:none;">
                                    <i class="fa fa-chevron-down text-muted"></i>
                                </span>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-admin-pink w-100 py-2 fs-5 fw-bold rounded-pill">أضف إلى السلة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <style>
        body {
            background: #f9fafb;
        }
        .product-section {
            min-height: 100vh;
        }
        .product-container {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 2px 2px 0 rgb(0, 0, 0, 0.2);
            padding: 2rem 1rem;
        }
        .product-card {
            background: transparent;
            border-radius: 0;
            box-shadow: none;
        }
        .btn-admin-pink {
            background: var(--admin-pink, #e91e63);
            color: #fff;
            border: none;
        }
        .btn-admin-pink:hover {
            background: #c2185b;
            color: #fff;
        }
        .price {
            color: var(--admin-pink, #e91e63);
        }
        .carousel-inner img {
            border-radius: 1rem;
        }
        .form-control, .form-select {
            border: 2px solid #e91e63;
            background: #fdf6fa;
            height: 38px !important;
            min-height: 34px !important;
            max-height: 48px !important;
            font-size: 1.1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #c2185b;
            box-shadow: 0 0 0 0.15rem #f8bbd0;
        }
        .badge.bg-primary {
            background: #e91e63 !important;
        }
        .form-select {
            padding-left: 2.5rem !important;
        }

        .product-card img {
            height: 100%;
        }
    </style>
@endpush
@endsection