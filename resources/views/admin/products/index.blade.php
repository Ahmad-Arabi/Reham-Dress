@extends('layouts.admin')
@section('title', 'إدارة المنتجات')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h1 class="fs-2 fw-semibold text-dark">إدارة المنتجات</h1>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
                إضافة منتج جديد
                <svg class="me-2" style="width: 1.25rem; height: 1.25rem;" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </a>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($products->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-end bg-white shadow-sm rounded">
                        <thead class="table-light">
                            <tr>
                                <th>الاسم</th>
                                <th>السعر</th>
                                <th>الألوان</th>
                                <th>الأحجام</th>
                                <th>الصور</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="fw-bold">{{ $product->name }}</td>
                                    <td>{{ $product->price }} د.أ</td>
                                    <td>
                                        @foreach ($product->colors as $color)
                                            <span
                                                class="badge bg-light text-dark border border-dark me-1">{{ $color->color }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($product->sizes as $size)
                                            <span class="badge bg-secondary me-1">{{ $size->age }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $totalImages = $product->images->count();
                                            if ($product->thumbnail) {
                                                $totalImages++;
                                            }
                                        @endphp

                                        @if ($totalImages > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                {{-- Show thumbnail first if exists --}}
                                                @if ($product->thumbnail)
                                                    <div class="position-relative">
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                                            width="50" height="50"
                                                            style="object-fit: cover; border-radius: 4px; border: 2px solid #007bff;">
                                                        <span class="position-absolute top-0 start-0 badge bg-primary" 
                                                              style="font-size: 0.6rem; transform: translate(-25%, -25%);">رئيسية</span>
                                                    </div>
                                                @endif

                                                {{-- Show additional images --}}
                                                @php
                                                    $remainingSlots = $product->thumbnail ? 2 : 3;
                                                @endphp
                                                @foreach ($product->images->take($remainingSlots) as $image)
                                                    <img src="{{ asset('storage/' . $image->path) }}" alt="صورة المنتج"
                                                        width="50" height="50"
                                                        style="object-fit: cover; border-radius: 4px;">
                                                @endforeach

                                                {{-- Show count of remaining images --}}
                                                @php
                                                    $shownImages = $product->thumbnail ? ($remainingSlots + 1) : $remainingSlots;
                                                    $remainingImages = $totalImages - $shownImages;
                                                @endphp
                                                @if ($remainingImages > 0)
                                                    <span class="badge bg-info d-flex align-items-center justify-content-center" 
                                                          style="width: 50px; height: 50px; border-radius: 4px;">
                                                        +{{ $remainingImages }}
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">لا توجد صور</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-primary btn-sm">تعديل</a>
                                            <a href="{{ route('admin.products.delete', $product->id) }}"
                                                class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                                <i class="bi bi-trash me-1"></i>
                                                حذف
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-warning text-center py-5">لا توجد منتجات حالياً.</div>
            @endif
        </div>
    </div>
@endsection