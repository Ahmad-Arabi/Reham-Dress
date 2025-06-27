@extends('layouts.admin')
@section('title', 'إدارة الطلبات')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fs-2 fw-semibold text-dark">تفاصيل الطلب</h1>
                <div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mb-3">
                        الرجوع إلى قائمة الطلبات
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">تفاصيل الطلب رقم <span class="text-admin-pink">{{ $order->id }}</span></h4>
                        <div class="text-muted small">تاريح الطلب: {{ $order->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                    <div>
                        <span class="badge bg-{{
                            $order->status === 'pending' ? 'warning' :
                            ($order->status === 'processing' ? 'info' :
                            ($order->status === 'shipped' ? 'primary' :
                            ($order->status === 'delivered' ? 'success' : 'secondary')))
                        }} fs-6">
                            @switch($order->status)
                                @case('pending') قيد الانتظار @break
                                @case('processing') قيد المعالجة @break
                                @case('shipped') تم الشحن @break
                                @case('delivered') تم التوصيل @break
                                @default ملغي
                            @endswitch
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">معلومات العميل</h6>
                            <div><strong>الاسم:</strong> {{ $order->user->name ?? 'لا يوجد' }}</div>
                            <div><strong>البريد الإلكتروني:</strong> {{ $order->user->email ?? 'لا يوجد' }}</div>
                            <div><strong>رقم الهاتف:</strong> {{ $order->phone }}</div>
                            <div><strong>العنوان:</strong> {{ $order->address }}</div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">معلومات الطلب</h6>
                            <div><strong>طريقة الدفع:</strong> {{ $order->payment_method == 'COD' ? 'الدفع عند الاستلام' : 'بطاقة ائتمان' }}</div>
                            <div><strong>كوبون الخصم:</strong> {{ $order->coupon ? $order->coupon->code : 'لا يوجد' }}</div>
                            <div><strong>رقم التتبع:</strong> {{ $order->tracking ?? 'لا يوجد' }}</div>
                        </div>
                    </div>
                    <h6 class="text-muted mb-3">عناصر الطلب</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-end">
                            <thead class="table-light">
                                <tr>
                                    <th>المنتج</th>
                                    <th>اللون</th>
                                    <th>المقاس</th>
                                    <th>الكمية</th>
                                    <th>السعر</th>
                                    <th>المجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            @if($item->product && $item->product->thumbnail)
                                                <img src="{{ asset('storage/products/thumbnails/' . $item->product->id . '/' . $item->product->thumbnail) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit:cover;">
                                            @endif
                                            <span>{{ $item->product ? $item->product->name : 'منتج غير متوفر' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $item->color }}</td>
                                    <td>{{ $item->age }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }} د.أ</td>
                                    <td>{{ $item->price * $item->quantity }} د.أ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>المجموع الفرعي:</strong></td>
                                    <td>{{ $order->total_amount + $order->discount_amount - $order->shipping_fee }} د.أ</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>رسوم الشحن:</strong></td>
                                    <td>{{ number_format($order->shipping_fee, 2) }} د.أ</td>
                                </tr>
                                @if ($order->discount_amount > 0)
                                <tr class="text-success">
                                    <td colspan="5" class="text-end text-success"><strong>الخصم:</strong></td>
                                    <td class="text-success">-{{ $order->discount_amount }} د.أ</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="5" class="text-end"><strong>المجموع الكلي:</strong></td>
                                    <td><strong>{{ $order->total_amount }} د.أ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
