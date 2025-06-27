@extends('layouts.admin')

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
                    <div class="card h-100 border-0 shadow-sm bg-admin-light-pink">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-bag fs-2 text-admin-pink"></i>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي الطلبات</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalOrders }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-white px-3 py-2 border-0">
                            <div class="small">
                                <a href="{{ route('admin.orders.index') }}" class="fw-medium text-admin-pink text-decoration-none">عرض جميع الطلبات</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm bg-admin-light-pink">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-currency-exchange fs-2 text-admin-pink"></i>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي المبيعات</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ number_format($totalRevenue, 2) }} دينار</div>
                            </div>
                        </div>
                        <div class="card-footer bg-white px-3 py-2 border-0">
                            <div class="small text-muted" style="font-size:0.75em;">
                                <i class="bi bi-info-circle me-1"></i>
                                يشمل الطلبات التي تم شحنها أو توصيلها فقط
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Products -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm bg-admin-light-pink">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-box-seam fs-2 text-admin-pink"></i>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي المنتجات</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalProducts }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-white px-3 py-2 border-0">
                            <div class="small">
                                <a href="{{ route('admin.products.index') }}" class="fw-medium text-admin-pink text-decoration-none">عرض جميع المنتجات</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Users -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm bg-admin-light-pink">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-people fs-2 text-admin-pink"></i>
                            </div>
                            <div>
                                <div class="small text-muted">إجمالي المستخدمين</div>
                                <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalUsers }}</div>
                            </div>
                        </div>
                        <div class="card-footer bg-white px-3 py-2 border-0">
                            <div class="small">
                                <a href="{{ route('admin.users.index') }}" class="fw-medium text-admin-pink text-decoration-none">عرض جميع المستخدمين</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="mt-4">
            <div class="card border-0 shadow-sm">
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
                                        <td class="text-end">{{ number_format($order->total_amount, 2) }} دينار</td>
                                        <td class="text-end">{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-admin-pink text-decoration-none">
                                                <i class="bi bi-eye"></i> عرض
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coupons Info -->
        <div class="mt-4">
            <div class="card border-0 shadow-sm bg-admin-light-pink">
                <div class="card-body d-flex align-items-center flex-wrap gap-4">
                    <div class="d-flex align-items-center me-4">
                        <i class="bi bi-ticket-perforated fs-2 text-admin-pink me-2"></i>
                        <div>
                            <div class="small text-muted">عدد الكوبونات المتاحة</div>
                            <div class="mt-1 fs-3 fw-semibold text-dark">{{ $totalCoupons }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center me-4">
                        <i class="bi bi-check-circle fs-4 text-success me-2"></i>
                        <div>
                            <div class="small text-muted">الكوبونات الفعالة</div>
                            <div class="mt-1 fs-5 fw-semibold text-dark">{{ \App\Models\Coupon::where('isFeatured', 1)->count() }}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-x-circle fs-4 text-danger me-2"></i>
                        <div>
                            <div class="small text-muted">الكوبونات غير الفعالة</div>
                            <div class="mt-1 fs-5 fw-semibold text-dark">{{ \App\Models\Coupon::where('isFeatured', 0)->count() }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white px-3 py-2 border-0">
                    <div class="small text-muted" style="font-size:0.85em;">
                        <i class="bi bi-info-circle me-1"></i>
                        يظهر للمستخدم فقط أحدث كوبون فعال.
                    </div>
                    <div class="small mt-1">
                        <a href="{{ route('admin.coupons.index') }}" class="fw-medium text-admin-pink text-decoration-none">إدارة الكوبونات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection