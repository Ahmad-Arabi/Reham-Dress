@extends('layouts.app')
@section('page_title', 'إتمام عملية الشراء')
@section('content')
    <div class="checkout-page">
        <div class="container mt-5 mb-5">
            <h1 class="checkout-title mb-4">إتمام عملية الشراء</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 fw-bold" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 fw-bold" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0 fw-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="d-grid gap-2 my-3 mx-1 justify-content-start ">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-right me-2"></i> العودة إلى السلة
                    </a>
                </div>

                <!-- Checkout Form -->
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">معلومات التوصيل</h5>
                        </div>
                        <div class="card-body">
                            <form id="checkoutForm" action="{{ route('checkout.place-order') }}" method="POST">
                                @csrf

                                @if(!empty($user->address) && !empty($user->phone))
                                    <div class="mb-3  address-box">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="address_option" id="use_existing" value="existing" checked>
                                            <label class="form-check-label" for="use_existing">
                                                استخدم العنوان ورقم الهاتف الحاليين:
                                                <div class="ps-3 fw-bold">
                                                    <div>العنوان: {{ $user->address }}</div>
                                                    <div>رقم الهاتف: {{ $user->phone }}</div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="radio" name="address_option" id="enter_new" value="new">
                                            <label class="form-check-label" for="enter_new">
                                                إدخال عنوان ورقم هاتف جديدين
                                            </label>
                                        </div>
                                        <div id="new_address_fields" class="mb-5" style="display: none;">
                                            <div class="mb-3">
                                                <label for="delivery_address" class="form-label">عنوان التوصيل</label>
                                                <input type="text" class="form-control" id="delivery_address" name="address"
                                                    value="{{ old('delivery_address') }}">
                                            </div>
                                            <div class="mb-5">
                                                <label for="phone" class="form-label">رقم الهاتف</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone"
                                                    value="{{ old('phone_number') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                @else
                                    <div class="mb-3">
                                        <label for="delivery_address" class="form-label">عنوان التوصيل</label>
                                        <input type="text" class="form-control" id="delivery_address" name="address"
                                            value="{{ old('delivery_address', $user->address ?? '') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="phone" class="form-label">رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone"
                                            value="{{ old('phone_number', $user->phone ?? '') }}">
                                    </div>
                                @endif

                                <div class=" p-0 mb-3">
                                    <h5 class="mb-0">طريقة الدفع</h5>
                                </div>

                                <div class="payment-methods mb-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="cash_on_delivery" value="COD" checked>
                                        <label class="form-check-label" for="cash_on_delivery">
                                            <i class="fa fa-money me-2"></i> الدفع نقدا عند الاستلام
                                        </label>
                                    </div>
                                </div>


                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg order-button"
                                        onclick="handlePayment(event)">
                                        تأكيد الطلب <i class="fa fa-check-circle ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card shadow-sm order-summary">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">ملخص الطلب</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="order-items">
                                @foreach ($cartItems as $item)
                                    <div class="order-item d-flex p-3 border-bottom">
                                        <div class="order-item-image me-3">
                                            <img src="{{ asset(Str::startsWith($item['image'], 'images/') ? $item['image'] : 'storage/products/thumbnails/' . $item['product_id'] . '/' . $item['image']) }}"
                                                alt="{{ $item['name'] }}" class="img-fluid rounded" width="60">
                                        </div>
                                        <div class="order-item-details flex-grow-1">
                                            <h6 class="item-name mb-1">{{ $item['name'] }}</h6>
                                            <div class="item-specs small text-muted">
                                                <div>المقاس: <span  class="fw-bold">{{ $item['size'] }}</span></div>
                                                <div>الكمية: <span class="fw-bold">{{ $item['quantity'] }}</span></div>
                                            </div>
                                        </div>
                                        <div class="order-item-price text-end">
                                            <span class="price fw-bold">{{ $item['subtotal'] }} دينار</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-totals p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-bold">المبلغ الإجمالي:</span>
                                    <strong>{{ $subtotal }} دينار</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-bold">رسوم الشحن:</span>
                                    <strong>                                       
                                        {{ number_format($shippingFees, 2) . ' دينار' }}                                      
                                    </strong>
                                </div>

                                @if ($discount > 0)
                                    <div class="d-flex justify-content-between mb-2 text-success">
                                        <span class="fw-bold">الخصم:</span>
                                        <strong>-{{ $discount }} دينار</strong>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between fw-bold">
                                    <span>المجموع:</span>
                                    <span class="order-total">{{ $totalPrice }} دينار</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coupon Code Section - Moved below the order summary -->
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">هل لديك كوبون؟</h5>
                        </div>
                        <div class="card-body">
                            @if ($appliedCoupon)
                                <div class="applied-coupon mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-success me-2">تم التطبيق</span>
                                            <strong>{{ $appliedCoupon['code'] }}</strong>
                                            <span class="text-muted ms-2">
                                               
                                                    ({{ $appliedCoupon['discount'] }} دينار)
                                            </span>
                                        </div>
                                        <form action="{{ route('checkout.remove-coupon') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-times me-1"></i> إلغاء
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('checkout.apply-coupon') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="coupon_code"
                                            placeholder="أدخل رمز الكوبون">
                                        <button type="submit"
                                            class="btn btn-outline-primary apply-btn">إدخال</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
    @push('styles')
        @vite(['resources/css/checkout.css'])
    @endpush

    @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const useExisting = document.getElementById('use_existing');
            const enterNew = document.getElementById('enter_new');
            const newFields = document.getElementById('new_address_fields');
            function toggleFields() {
                newFields.style.display = enterNew.checked ? 'block' : 'none';
            }
            useExisting.addEventListener('change', toggleFields);
            enterNew.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
    @endpush

