@extends('layouts.admin')
@section('title', 'إضافة منتج جديد')
@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="fs-2 fw-semibold text-dark">إضافة منتج جديد</h1>
            <div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary mt-3">
                    الرجوع إلى قائمة المنتجات
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 800px; margin: auto;">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">اسم المنتج</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">السعر</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">الكمية المتاحة</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">الصورة الرئيسية</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
            </div>

            <div class="mb-3">
                <label class="form-label">ألوان المنتج</label>
                <input type="text" class="form-control" name="colors[]" placeholder="أدخل لون (مثال: أحمر, أزرق)">
               
                <div id="extra-colors"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">الأعمار (المقاسات)</label>
                <input type="text" class="form-control" name="sizes[]" placeholder="مثال: من 3 إلى 5 سنوات, من 8 إلى 10 سنوات">
            
                <div id="extra-sizes"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">صور إضافية</label>
                <input type="file" class="form-control" name="images[]" multiple>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success px-4">إضافة المنتج</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function addColorInput() {
        const div = document.createElement('div');
        div.innerHTML = '<input type="text" class="form-control mt-2" name="colors[]" placeholder="لون إضافي">';
        document.getElementById('extra-colors').appendChild(div);
    }

    function addSizeInput() {
        const div = document.createElement('div');
        div.innerHTML = '<input type="text" class="form-control mt-2" name="sizes[]" placeholder="مقاس إضافي">';
        document.getElementById('extra-sizes').appendChild(div);
    }
</script>
@endpush
@endsection
