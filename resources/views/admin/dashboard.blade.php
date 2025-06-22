@extends('admin.layouts.app')

@section('content')
<div class="py-4">
    <div class="container-fluid">
        <h1 class="fs-2 fw-semibold text-dark">لوحة التحكم</h1>
    </div>
    <div class="container-fluid">
        <!-- Stats -->
        <div class="mt-4">
            <div class="row g-3">
                <!-- Total Orders -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <svg class="" style="width: 2rem; height: 2rem; color: #adb5bd;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي الطلبات</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalOrders }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-light px-3 py-2">
                            <div class="small">
                                <a href="{{ route('admin.settings.general') }}" class="fw-medium text-primary text-decoration-none">عرض جميع الطلبات</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <svg style="width: 2rem; height: 2rem; color: #adb5bd;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي المبيعات</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ number_format($totalRevenue, 2) }} ريال</div>
                            </div>
                        </div>
                        <div class="card-footer bg-light px-3 py-2">
                            <div class="small">
                                <a href="{{ route('admin.orders.index') }}" class="fw-medium text-primary text-decoration-none">عرض التقرير</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Products -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <svg style="width: 2rem; height: 2rem; color: #adb5bd;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي المنتجات</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalProducts }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-light px-3 py-2">
                            <div class="small">
                                <a href="{{ route('admin.products.index') }}" class="fw-medium text-primary text-decoration-none">عرض جميع المنتجات</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Users -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <svg style="width: 2rem; height: 2rem; color: #adb5bd;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي المستخدمين</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalUsers }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-light px-3 py-2">
                            <div class="small">
                                <a href="{{ route('admin.users.index') }}" class="fw-medium text-primary text-decoration-none">عرض جميع المستخدمين</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="mt-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h3 class="fs-5 fw-medium text-dark mb-0">آخر الطلبات</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-end small">رقم الطلب</th>
                                    <th scope="col" class="text-end small">العميل</th>
                                    <th scope="col" class="text-end small">الحالة</th>
                                    <th scope="col" class="text-end small">المجموع</th>
                                    <th scope="col" class="text-end small">التاريخ</th>
                                    <th scope="col" class="text-end small">عرض</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="text-end fw-bold">#{{ $order->id }}</td>
                                        <td class="text-end">{{ $order->user->name }}</td>
                                        <td class="text-end">
                                            <span class="badge {{ $order->status_bg }} {{ $order->status_color }}">{{ $order->status_text }}</span>
                                        </td>
                                        <td class="text-end">{{ number_format($order->total, 2) }} ريال</td>
                                        <td class="text-end">{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-primary text-decoration-none">عرض</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="mt-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h3 class="fs-5 fw-medium text-dark mb-0">المنتجات منخفضة المخزون</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-end small">المنتج</th>
                                    <th scope="col" class="text-end small">السعر</th>
                                    <th scope="col" class="text-end small">المخزون</th>
                                    <th scope="col" class="text-end small">تعديل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockProducts as $product)
                                    <tr>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="ms-3" style="width: 40px; height: 40px;">
                                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded-circle object-fit-cover" style="width: 40px; height: 40px;">
                                                </div>
                                                <div>
                                                    <div class="fw-medium text-dark">{{ $product->name }}</div>
                                                    <div class="small text-muted">{{ $product->category->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">{{ number_format($product->price, 2) }} ريال</td>
                                        <td class="text-end">{{ $product->stock }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-primary text-decoration-none">تعديل</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection