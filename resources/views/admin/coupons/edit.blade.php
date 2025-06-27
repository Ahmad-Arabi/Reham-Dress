@extends('layouts.admin')
@section('title', 'إدارة الكوبونات')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fs-2 fw-semibold text-dark">تعديل الكوبون {{ $coupon->code }}</h1>
                <div>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary  mt-3">
                        الرجوع إلى قائمة الكوبونات

                    </a>
                </div>
            </div>
        </div>



        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.coupons.update', $coupon->id) }}"
                class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 600px; margin: auto;">
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
                <div class="mb-3">
                    <label for="code" class="form-label">كود الكوبون</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}">
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">قيمة الخصم</label>
                    <input type="number" class="form-control" id="discount" name="discount"
                        value="{{ old('discount') ?? $coupon->discount }}">
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">تاريخ البدء</label>
                    <input type="date" class="form-control" id="start_date" name="start_date"
                        value="{{ old('start_date') ?? $coupon->start_date }}">
                </div>
                <div class="mb-3">
                    <label for="expiry_date" class="form-label">تاريخ الانتهاء</label>
                    <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                        value="{{ old('expiry_date') ?? $coupon->expiry_date }}">
                </div>
                <div class="mb-3">
                    <label for="isFeatured" class="form-label">الحالة</label>
                    <div class="position-relative">
                        <select class="form-select pe-5" id="isFeatured" name="isFeatured">
                            <option value="1" {{ (old('isFeatured') ?? $coupon->isFeatured) == 1 ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ (old('isFeatured') ?? $coupon->isFeatured) == 0 ? 'selected' : '' }}>غير
                                فعال</option>
                        </select>
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                            style="pointer-events:none;">
                            <i class="fa fa-chevron-down text-muted"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">تعديل الكوبون</button>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
