@extends('layouts.admin')
@section('title', 'حذف المنتج')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fs-2 fw-semibold text-danger">تأكيد حذف المنتج</h1>
            </div>

            <div class="container-fluid">
                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                    class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 600px; margin: auto;">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <p class="mb-4 fs-5">هل أنت متأكد أنك تريد حذف المنتج <strong>{{ $product->name }}</strong>؟</p>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger px-4">حذف المنتج</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2">إلغاء</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
