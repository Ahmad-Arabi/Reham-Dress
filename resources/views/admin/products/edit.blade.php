@extends('layouts.admin')
@section('title', 'تعديل المنتج')
@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="fs-2 fw-semibold text-dark">تعديل المنتج {{ $product->name }}</h1>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary mt-3">الرجوع إلى جميع المنتجات</a>
        </div>

        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data"
                class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 700px; margin: auto;">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">اسم المنتج</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">السعر (دينار)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">الكمية المتوفرة</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">الصورة الرئيسية</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">صور إضافية</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                </div>

                <div class="mb-3">
                    <label for="colors" class="form-label">الألوان (افصل بينها بفاصلة)</label>
                    <input type="text" class="form-control" id="colors" name="colors" value="{{ old('colors', implode(', ', $product->colors->pluck('color')->toArray())) }}">
                </div>

                <div class="mb-3">
                    <label for="sizes" class="form-label">الأعمار (افصل بينها بفاصلة)</label>
                    <input type="text" class="form-control" id="sizes" name="sizes" value="{{ old('sizes', implode(', ', $product->sizes->pluck('age')->toArray())) }}">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success px-4">تحديث المنتج</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
