@extends('layouts.app')
@section('page_title', 'تأكيد الطلب رقم ' . $order->id)
@push('styles')
    @vite(['resources/css/confirmation.css'])
@endpush
@section('content')
    <div class="order-confirmation-page">
        <div class="container mt-5 mb-5">
            <div class="text-center mb-5">
                <div class="success-icon mb-4">
                    <i class="fa fa-check-circle text-success" style="font-size: 5rem;"></i>
                </div>
                <h1 class="confirmation-title mb-2">شكراً لطلبك!
                </h1>
                <p class="lead text-muted">تم إنشاء طلبك بنجاح.

                </p>
            </div>
            <div class="container text-center mb-3">
                {{-- <p class="mb-4">A confirmation email has been sent to your email address.</p> --}}
                <div class="d-flex justify-content-center gap-2 gap-sm-3">
                    <a href="" class="btn btn-primary mx-1">
                        <i class="fa fa-list-alt me-2"></i> عرض طلباتي
                    </a>
                    <a href="" class="btn btn-outline-secondary mx-1">
                        <i class="fa fa-shopping-bag me-2"></i> متابعة التسوق
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">رقم الطلب: {{ $order->id }}</h5>
                                <span class="badge bg-primary">الحالة: {{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">تفاصيل الطلب</h6>
                                    <p class="mb-1"><strong>تاريخ الطلب:</strong>
                                        {{ $order->created_at->format('F j, Y, g:i a') }}</p>
                                    <p class="mb-1"><strong>الإجمالي:</strong> {{ $order->total_price }} دينار</p>
                                    <p class="mb-0"><strong>طريقة الدفع:</strong>
                                        @if (stripos($order->payment_method, 'COD') !== false)
                                            الدفع عند الاستلام
                                        @else
                                            بطاقة ائتمان
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">معلومات الشحن</h6>
                                    <p class="mb-1"><strong>العنوان:</strong> {{ $order->address }}</p>
                                    <p class="mb-0"><strong>الهاتف:</strong> {{ $order->phone }}</p>
                                </div>
                            </div>

                            <h6 class="text-muted mb-3">عناصر الطلب:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>المنتج</th>
                                            <th>المقاس</th>
                                            <th>الكمية</th>
                                            <th>السعر</th>
                                            <th>المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td data-label="المنتج">
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->product)
                                                            @if ($item->product->thumbnail)
                                                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                                    alt="{{ $item->product->name }}"
                                                                    class="img-thumbnail me-2" style="width: 50px;">
                                                            @endif
                                                            {{ $item->product->name }}
                                                        @else
                                                            Product not available
                                                        @endif
                                                    </div>
                                                </td>
                                                <td data-label="المقاس">{{ $item->age }}</td>
                                                <td data-label="الكمية">{{ $item->quantity }}</td>
                                                <td data-label="السعر">{{ $item->price }} JOD</td>
                                                <td data-label="المجموع">{{ $item->price * $item->quantity }} دينار</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>المبلغ الإجمالي:</strong></td>
                                            <td>{{  $order->total_amount + $order->discount_amount - $order->shipping_fee  }}
                                                دينار</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>رسوم الشحن:</strong></td>
                                            <td>

                                                    {{ number_format($order->shipping_fee, 2) . ' دينار' }}
                               
                                            </td>
                                        </tr>
                                        @if ($order->discount_amount > 0)
                                            <tr class="text-success">
                                                <td colspan="4" class="text-end"><strong>الخصم:</strong></td>
                                                <td>-{{ $order->discount_amount }} دينار</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>المجموع الكلي:</strong></td>
                                            <td><strong>{{ $order->total_amount }} دينار</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
