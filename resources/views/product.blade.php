@extends('layouts.app')

@section('page_title', 'تفاصيل المنتج')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="product-card" style="max-width:100%">
                @if($product->images && count($product->images))
                    <img src="{{ asset($product->images[0]->path) }}" alt="{{ $product->name }}" class="w-100 mb-4" style="max-height:350px;object-fit:cover;">
                @else
                    <img src="{{ asset('images/fallback.jpg') }}" alt="{{ $product->name }}" class="w-100 mb-4" style="max-height:350px;object-fit:cover;">
                @endif
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h2 class="mb-3">{{ $product->name }}</h2>
            <div class="price mb-3">{{ $product->price }} ر.س</div>
            <p class="mb-4">{{ $product->description }}</p>
            @if($product->colors && count($product->colors))
                <div class="mb-3">
                    <strong>الألوان المتوفرة:</strong>
                    @foreach($product->colors as $color)
                        <span style="display:inline-block;width:20px;height:20px;background:{{ $color->color }};border-radius:50%;border:1px solid #ccc;margin-left:5px;"></span>
                    @endforeach
                </div>
            @endif
            @if($product->sizes && count($product->sizes))
                <div class="mb-3">
                    <strong>المقاسات المتوفرة:</strong>
                    @foreach($product->sizes as $size)
                        <span class="badge bg-secondary mx-1">{{ $size->age }}</span>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('cart.add') }}" method="POST" class="mb-0">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label for="quantity">الكمية:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control w-25 d-inline-block" style="width:80px;">
                </div>
                @if($product->colors && count($product->colors))
                    <div class="mb-3">
                        <label for="color">اختر اللون:</label>
                        <select name="color" id="color" class="form-select w-50 d-inline-block">
                            @foreach($product->colors as $color)
                                <option value="{{ $color->id }}">{{ $color->color }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if($product->sizes && count($product->sizes))
                    <div class="mb-3">
                        <label for="size">اختر المقاس:</label>
                        <select name="size" id="size" class="form-select w-50 d-inline-block">
                            @foreach($product->sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->age }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary w-50">أضف إلى السلة</button>
            </form>
        </div>
    </div>
</div>
@endsection 