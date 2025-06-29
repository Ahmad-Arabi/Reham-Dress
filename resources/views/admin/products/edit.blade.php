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
                        <img src="{{ asset('storage/products/thumbnails/' . $product->id . '/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="80">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">صور إضافية</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    
                    <!-- Display existing additional images -->
                    @if($product->images->count() > 0)
                        <div class="mt-3">
                            <label class="form-label">الصور الإضافية الحالية:</label>
                            <div class="row">
                                @foreach($product->images as $image)
                                    <div class="col-md-3 mb-2">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="صورة المنتج" class="img-thumbnail" width="100">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Delete All Images Section -->
                @if($product->thumbnail || $product->images->count() > 0)
                    <div class="mb-3 p-3 border rounded bg-light">
                        <h6 class="text-danger">إدارة الصور</h6>
                        <p class="text-muted mb-3">
                            @if($product->thumbnail && $product->images->count() > 0)
                                يحتوي هذا المنتج على صورة رئيسية و {{ $product->images->count() }} صورة إضافية
                            @elseif($product->thumbnail)
                                يحتوي هذا المنتج على صورة رئيسية فقط
                            @else
                                يحتوي هذا المنتج على {{ $product->images->count() }} صورة إضافية
                            @endif
                        </p>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteImagesModal">
                            <i class="fas fa-trash"></i> حذف جميع الصور
                        </button>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">ألوان المنتج</label>
                    <div id="colors-list">
                        @foreach(old('colors', $product->colors->pluck('color')->toArray()) as $color)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="colors[]" value="{{ $color }}" placeholder="لون المنتج">
                                <button type="button" class="btn btn-outline-danger remove-color">&times;</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addColorInput()">إضافة لون آخر</button>
                </div>
                <div class="mb-3">
                    <label class="form-label">الأعمار (المقاسات)</label>
                    <div id="sizes-list">
                        @foreach(old('sizes', $product->sizes->pluck('age')->toArray()) as $size)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="sizes[]" value="{{ $size }}" placeholder="مقاس المنتج">
                                <button type="button" class="btn btn-outline-danger remove-size">&times;</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSizeInput()">إضافة مقاس آخر</button>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success px-4">تحديث المنتج</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Images Confirmation Modal -->
<div class="modal fade" id="deleteImagesModal" tabindex="-1" aria-labelledby="deleteImagesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImagesModalLabel">تأكيد حذف جميع الصور</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger fw-bold">تحذير!</p>
                <p>هل أنت متأكد من رغبتك في حذف جميع صور هذا المنتج؟</p>
                <p class="text-muted">
                    سيتم حذف:
                    @if($product->thumbnail)
                        • الصورة الرئيسية<br>
                    @endif
                    @if($product->images->count() > 0)
                        • {{ $product->images->count() }} صورة إضافية
                    @endif
                </p>
                <p class="text-danger"><strong>هذا الإجراء لا يمكن التراجع عنه!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form method="POST" action="{{ route('admin.products.deleteAllImages', $product->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف جميع الصور</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function addColorInput() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = '<input type="text" class="form-control" name="colors[]" placeholder="لون إضافي"><button type="button" class="btn btn-outline-danger remove-color">&times;</button>';
        document.getElementById('colors-list').appendChild(div);
    }
    function addSizeInput() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = '<input type="text" class="form-control" name="sizes[]" placeholder="مقاس إضافي"><button type="button" class="btn btn-outline-danger remove-size">&times;</button>';
        document.getElementById('sizes-list').appendChild(div);
    }
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-color')) {
            e.target.parentElement.remove();
        }
        if (e.target.classList.contains('remove-size')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endpush
@endsection