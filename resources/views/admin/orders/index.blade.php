@extends('layouts.admin')
@section('title', 'إدارة الطلبات')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fs-2 fw-semibold text-dark">إدارة الطلبات</h1>

            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 border-2 border-success shadow-sm" role="alert"
                style="background:#f0fdf4; color:#166534; font-weight:600;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 border-2 border-danger shadow-sm" role="alert"
                style="background:#fef2f2; color:#991b1b; font-weight:600;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show mb-4 border-2 border-info shadow-sm" role="alert"
                style="background:#f0f9ff; color:#0c4a6e; font-weight:600;">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
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
            <input type="text" id="searchInput" name="search" data-filter="search"
                placeholder=" رقم الطلب،الهاتف أو البريد إلكتروني..." class="form-control search-filter-input"
                style="max-width: 280px;" value="{{ request('search', '') }}">
            <div class="position-relative" style="max-width: 150px; display:inline-block;">
                <select id="statusFilter" name="status" data-filter="status" class="form-select search-filter-input pe-5">
                    <option value="" {{ request('status', '') === '' ? 'selected' : '' }}>جميع الحالات</option>
                    <option value="pending" {{ request('status', '') === 'pending' ? 'selected' : '' }}> قيد الانتظار
                    </option>
                    <option value="proessing" {{ request('status', '') === 'proessing' ? 'selected' : '' }}> قيد المعالجة
                    </option>
                    <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                    <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}> تم التوصيل</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                </select>
                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="pointer-events:none;">
                    <i class="fa fa-chevron-down text-muted"></i>
                </span>
            </div>
        </div>

        <!-- جدول الكوبونات -->
        @if ($orders->count())
            <div class="mt-4 table-responsive">
                <table class="table table-bordered table-hover align-middle text-end bg-white shadow-sm rounded">
                    <thead class="table-light">
                        <tr>
                            <th>رقم الطلب</th>
                            <th>حالة الطلب</th>
                            <th>البريد الالكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>الاجمالي</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="fw-bold">{{ $order->id }}</td>
                                <td>
                                    @php
                                        $badge = [
                                            'pending' => ['color' => 'warning'],
                                            'processing' => ['color' => 'info'],
                                            'shipped' => ['color' => 'primary'],
                                            'delivered' => ['color' => 'success'],
                                            'cancelled' => ['color' => 'secondary'],
                                        ];
                                        $map = $badge[$order->status] ?? ['color' => 'secondary'];
                                    @endphp
                                    <span class="badge bg-{{ $map['color'] }} d-inline-flex align-items-center"
                                        style="font-size:0.9rem;">
                                        <span class="ms-1">
                                            @switch($order->status)
                                                @case('pending')
                                                    قيد الانتظار
                                                @break

                                                @case('processing')
                                                    قيد المعالجة
                                                @break

                                                @case('shipped')
                                                    تم الشحن
                                                @break

                                                @case('delivered')
                                                    تم التوصيل
                                                @break

                                                @default
                                                    ملغي
                                            @endswitch
                                        </span>
                                    </span>
                                </td>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->total_amount }} دينار</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-start">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="btn btn-details btn-sm d-flex align-items-center gap-1">
                                            <i class="bi bi-eye me-1"></i>
                                            التفاصيل
                                        </a>
                                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                                            class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                                            <i class="bi bi-pencil-square me-1"></i>
                                            تعديل/تحديث
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        @else
            <div class="d-flex flex-column align-items-center justify-content-center py-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24"
                    stroke="var(--admin-pink)" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 13h6m-3-3v6m9-2.25V6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25z" />
                </svg>
                <div class="mt-3 fs-5 text-admin-pink fw-semibold">لا توجد طلبات</div>
            </div>
        @endif

    </div>


    @vite(['resources/js/admin.js'])

    <style>

    </style>

@endsection
