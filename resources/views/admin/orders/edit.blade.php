@extends('layouts.admin')
@section('title', 'إدارة الطلبات')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fs-2 fw-semibold text-dark">تعديل الطلب {{ $order->id }}</h1>
                <div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary  mt-3">
                        الرجوع إلى قائمة الطلبات

                    </a>
                </div>
            </div>
        </div>



        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}"
                class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 900px; margin: auto;">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4 border-2 border-danger shadow-sm"
                        role="alert" style="background:#fef2f2; color:#991b1b; font-weight:600;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                @method('PUT')
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="status" class="form-label">حالة الطلب</label>
                        <div class="position-relative">
                            <select class="form-select pe-5" id="status" name="status">
                                <option value="cancelled"
                                    {{ (old('status') ?? $order->status) == 'cancelled' ? 'selected' : '' }}>ملغي
                                </option>
                                <option value="pending"
                                    {{ (old('status') ?? $order->status) == 'pending' ? 'selected' : '' }}>قيد
                                    التنفيذ</option>
                                <option value="processing"
                                    {{ (old('status') ?? $order->status) == 'processing' ? 'selected' : '' }}>قيد
                                    المعالجة</option>
                                <option value="shipped"
                                    {{ (old('status') ?? $order->status) == 'shipped' ? 'selected' : '' }}>تم
                                    الشحن</option>
                                <option value="delivered"
                                    {{ (old('status') ?? $order->status) == 'delivered' ? 'selected' : '' }}>تم
                                    التوصيل</option>
                            </select>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                style="pointer-events:none;">
                                <i class="fa fa-chevron-down text-muted"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tracking" class="form-label">رقم/رابط التتبع</label>
                        <input type="text" class="form-control" id="tracking" name="tracking"
                            value="{{ old('tracking') ?? $order->tracking }}">
                        <div class="mb-2">
                            <small class="text-muted" style="font-size: 0.85em;">
                                <i class="bi bi-info-circle me-1"></i>
                                يمكنك إدخال رقم التتبع، اسم شركة الشحن أو تفاصيل التتبع ليتم عرضها للمستخدم في صفحة الطلبات.
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') ?? $order->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">عنوان التوصيل</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') ?? $order->address }}">
                    </div>
                </div>
                <hr class="my-4">
                <h5 class="mb-3">عناصر الطلب</h5>
                <div class="order-items-list">
                    @if (count($order->orderItems))
                        @foreach ($order->orderItems as $i => $item)
                            <div
                                class="d-flex align-items-center gap-3 mb-3 p-3 border rounded bg-admin-light-pink flex-wrap">
                                <div style="min-width:70px;">

                                    <img src="{{ $item->product->thumbnail ? asset('storage/products/thumbnails/' . $item->product->id . '/' . $item->product->thumbnail) : asset('images/fallback.jpg') }}"
                                        alt="{{ $item->product->name }}" class="img-thumbnail"
                                        style="width: 70px; height: 70px; object-fit:cover;">

                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1">
                                        {{ $item->product ? $item->product->name : 'منتج غير متوفر' }}
                                        <span class="badge bg-warning text-dark ms-2">الكمية: {{ $item->quantity }}</span>
                                        <span class="badge bg-primary ms-2">السعر: {{ $item->price }} د.أ</span>
                                    </div>
                                    <input type="hidden" name="order_items[{{ $i }}][id]"
                                        value="{{ $item->id }}">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label">اللون</label>
                                            <div class="position-relative">
                                                <select name="order_items[{{ $i }}][color]"
                                                    class="form-select admin-light-pink-input pe-5">
                                                    @if ($item->product && $item->product->colors)
                                                        @foreach ($item->product->colors as $color)
                                                            <option value="{{ $color->color }}"
                                                                {{ $item->color == $color->color ? 'selected' : '' }}>
                                                                {{ $color->color }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="{{ $item->color }}" selected>{{ $item->color }}
                                                        </option>
                                                    @endif
                                                </select>
                                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                                    style="pointer-events:none;">
                                                    <i class="fa fa-chevron-down text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">المقاس</label>
                                            <div class="position-relative">
                                                <select name="order_items[{{ $i }}][age]"
                                                    class="form-select admin-light-pink-input pe-5">
                                                    @if ($item->product && $item->product->sizes)
                                                        @foreach ($item->product->sizes as $size)
                                                            <option value="{{ $size->age }}"
                                                                {{ $item->age == $size->age ? 'selected' : '' }}>
                                                                {{ $size->age }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="{{ $item->age }}" selected>{{ $item->age }}
                                                        </option>
                                                    @endif
                                                </select>
                                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                                    style="pointer-events:none;">
                                                    <i class="fa fa-chevron-down text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning text-center py-4"
                            style="font-size: 1.2rem; background: #fffbe6; color: #b38f00;">
                            لا توجد عناصر في هذا الطلب
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success px-4">تعديل الطلب</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
