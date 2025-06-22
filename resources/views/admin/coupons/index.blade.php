@extends('layouts.admin')
@section('title', 'إدارة الكوبونات')
@section('content')
<div class="py-4">
    <div class="container-fluid">
        <div class="mb-4">
            <h1 class="fs-2 fw-semibold text-dark">إدارة الكوبونات</h1>
            <div>
                <a href="{{  route('admin.coupons.create') }}" class="btn btn-primary  mt-3">
                    <svg class="me-2" style="width: 1.25rem; height: 1.25rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    إضافة كوبون جديد
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-2 border-success shadow-sm" role="alert" style="background:#f0fdf4; color:#166534; font-weight:600;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 border-2 border-danger shadow-sm" role="alert" style="background:#fef2f2; color:#991b1b; font-weight:600;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show mb-4 border-2 border-info shadow-sm" role="alert" style="background:#f0f9ff; color:#0c4a6e; font-weight:600;">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong>حدثت أخطاء:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- أدوات التصفية والبحث -->
    <div class="filters-row mb-3">
        <input type="text" id="searchInput" name="search" data-filter="search" placeholder="بحث عن كوبون..." class="form-control search-filter-input" style="max-width: 220px;" value="{{ request('search', '') }}">
        <select id="statusFilter" name="status" data-filter="status" class="form-select search-filter-input" style="max-width: 180px;">
            <option value="" {{ request('status', '') === '' ? 'selected' : '' }}>جميع الحالات</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>نشط</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>غير نشط</option>
        </select>
    </div>
    
    <!-- جدول الكوبونات -->
    @if($coupons->count())
    <div class="mt-4 table-responsive">
        <table class="table table-bordered table-hover align-middle text-end bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>الكوبون</th>
                    <th>قيمة الخصم</th>
                    <th>المدة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <td class="fw-bold">{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount }} دينار</td>
                    <td>{{ $coupon->start_date}} - {{ $coupon->expiry_date }}</td>
                    <td>
                        <span class="badge @if($coupon->isFeatured === 1) bg-success text-success-emphasis @else bg-danger text-danger-emphasis @endif">
                           @if ($coupon->isFeatured === 1)
                               فعال
                           @else
                               غير فعال
                           @endif
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                            <a href="{{ route('admin.coupons.delete', $coupon->id) }}" class="btn btn-danger btn-sm">حذف</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $coupons->links() }}
    </div>
    @else
    <div class="d-flex flex-column align-items-center justify-content-center py-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="var(--admin-pink)" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m9-2.25V6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25z" />
        </svg>
        <div class="mt-3 fs-5 text-admin-pink fw-semibold">لا توجد كوبونات حالياً</div>
    </div>
    @endif
    
</div>


@vite(['resources/js/admin.js'])

<style>

</style>

@endsection