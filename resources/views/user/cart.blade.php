@extends('layouts.app')
@section('page_title', 'سلة التسوق')
@section('content')
    <div class="cart-page">
        <div class="container py-5 mt-3 mb-5">
            <h1 class="cart-title mb-4">محتويات السلة</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(count($cartItems) > 0)
                <div class="cart-container">
                    <div class="checkout-section d-md-none mb-3">
                        <a href="{{ route('checkout')}}" class="btn btn-primary btn-lg checkout-btn">
                            المتابعة إلى الدفع <i class="fa fa-arrow-left ms-2"></i>
                        </a>
                    </div>
                    <!-- Cart items for desktop -->
                    <div class="card shadow-sm d-none d-md-block">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover cart-table mb-0 cart-background">
                                    <thead class="thead">
                                        <tr>
                                            <th class="product-col"></th>
                                            <th class="product-col">المنتج</th>
                                            <th>المقاس</th>
                                            <th>اللون</th>
                                            <th class="price-col">السعر</th>
                                            <th class="quantity-col">الكمية</th>
                                            <th class="subtotal-col">المجموع</th>
                                            <th class="action-col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart-background">
                                        @foreach($cartItems as $item)
                                            <tr class="cart-item cart-background" data-id="{{ $item['id'] }}">
                                                <td class="product-col">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset(Str::startsWith($item['image'], 'images/') ? $item['image'] : 'storage/products/thumbnails/' . $item['product_id'] . '/' . $item['image']) }}" 
                                                             alt="{{ $item['name'] }}" class="cart-product-image">
                                        
                                                    </div>
                                                </td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['size'] }}</td>
                                                <td>
                                                    @if($item['color'])
                                                        <div class="product-color d-flex align-items-center">
                                                            <span class="color-dot" style="background-color: {{ $item['color'] }}"></span>
                                                            <span class="ms-2">{{ $item['color'] ?? '' }}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="price-col">{{ $item['price'] }} دينار</td>
                                                <td class="quantity-col">
                                                    <div class="quantity-control">
                                                        <button type="button" class="btn-qty increase" data-item-id="{{ $item['id'] }}" data-item-name="{{ $item['name'] }}">-</button>
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-input" data-id="{{ $item['id'] }}">
                                                        <button type="button" class="btn-qty decrease">+</button>
                                                    </div>
                                                </td>
                                                <td class="subtotal-col">
                                                    <span class="subtotal" data-id="{{ $item['id'] }}">{{ number_format($item['subtotal'], 2) }}</span> دينار
                                                </td>
                                                <td class="action-col">
                                                    <button type="button" class="btn-remove border-0 bg-transparent p-0" data-bs-toggle="modal" data-bs-target="#deleteModal" data-item-id="{{ $item['id'] }}" data-item-name="{{ $item['name'] }}">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile cart items view -->
                    <div class="d-md-none mobile-cart">
                        @foreach($cartItems as $item)
                            <div class="card cart-item-card mb-3 cart-background" data-id="{{ $item['id'] }}">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="card-title product-name mb-0">{{ $item['name'] }}</h5>
                                        <button type="button" class="btn-remove border-0 bg-transparent p-0" data-bs-toggle="modal" data-bs-target="#deleteModal" data-item-id="{{ $item['id'] }}" data-item-name="{{ $item['name'] }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <img src="{{ asset(Str::startsWith($item['image'], 'images/') ? $item['image'] : 'storage/products/thumbnails/' . $item['product_id'] . '/' . $item['image']) }}" 
                                                alt="{{ $item['name'] }}" class="img-fluid rounded">
                                        </div>
                                        <div class="col-8">
                                            <div class="specs">
                                                <p class="mb-1"><strong>المقاس:</strong> {{ $item['size'] }}</p>
                                                
                                                @if($item['color'])
                                                <p class="mb-1 d-flex align-items-center">
                                                    <strong>اللون:</strong>&nbsp;
                                                    <span class="color-dot ms-1 me-2" style="background-color: {{ $item['color'] }}"></span>
                                                    @if(isset($item['color_name']) && $item['color_name'])
                                                        <span class="color-name">{{ $item['color_name'] }}</span>
                                                    @endif
                                                </p>
                                                @endif
                                            
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price-wrap">
                                            <p class="mb-0"><strong>السعر:</strong> {{ $item['price'] }} دينار</p>
                                            <p class="mb-0"><strong>المجموع:</strong> <span class="subtotal" data-id="{{ $item['id'] }}">{{ $item['subtotal'] }}</span> دينار</p>
                                        </div>
                                        
                                        <div class="quantity-control compact">
                                            <button type="button" class="btn-qty increase">-</button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-input" data-id="{{ $item['id'] }}">
                                            <button type="button" class="btn-qty decrease">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Cart summary section -->
                    <div class="card shadow-sm mt-4 cart-background">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <h5>ملخص السلة</h5>
                                        <div class="d-flex justify-content-between">
                                            <span>المجموع الكلي :</span>
                                            <strong class="cart-total">{{ number_format($totalPrice, 2) }} دينار</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cart actions -->
                    <div class="cart-actions d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mt-4">
                        <div class="action-buttons mb-3 mb-md-0 d-flex w-100 justify-content-between gap-2 d-md-row">
                            <a href="{{ route('shop')}}" class="btn btn-outline-secondary">
                                متابعة التسوق
                            </a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#clearCartModal">
                                <i class="fa fa-trash-o me-2 "></i> إفراغ السلة
                            </button>
                        </div>
                        
                        <div class="checkout-section d-none d-md-flex">
                            <a href="{{ route('checkout')}}" class="btn btn-primary btn-lg checkout-btn">
                                المتابعة إلى الدفع <i class="fa fa-arrow-left ms-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="checkout-section d-md-none">
                        <a href="{{ route('checkout')}}" class="btn btn-primary btn-lg checkout-btn">
                            المتابعة إلى الدفع <i class="fa fa-arrow-left ms-2"></i>
                        </a>
                    </div>
                </div>
            @else
                <div class="empty-cart text-center py-5">
                    <div class="empty-cart-icon mb-3">
                        <i class="fa fa-shopping-cart fa-3x text-muted shopping-cart"></i>
                    </div>
                    <h3 class="mb-3">سلة المنتجات فارغة</h3>
                    <p class="mb-4">يبدو أنك لم تقم بإضافة أي منتجات بعد.</p>
                    <a href="{{ route('shop')}}" class="btn btn-primary cancel-btn">
                        <i class="fa fa-arrow-left me-2"></i>  بدء التسوق
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Delete Item Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد إزالة المنتج من السلة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد إزالة <span id="delete-item-name"></span> من سلة التسوق الخاصة بك؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">إلغاء</button>
                    <a href="#" id="confirm-delete" class="btn btn-danger remove-btn">تأكيد</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Clear Cart Modal -->
    <div class="modal fade" id="clearCartModal" tabindex="-1" aria-labelledby="clearCartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clearCartModalLabel">إفراغ السلة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد إفراغ سلة التسوق بالكامل؟ 
                    <p class="text-danger">لا يمكن التراجع عن هذا الإجراء.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <a href="{{ route('cart.clear') }}" class="btn btn-danger">تأكيد</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
    
    @push('styles')
        @vite(['resources/css/cart.css'])
    @endpush
    
    @push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $(document).ready(function() {
                // Delete modal
                    $('#deleteModal').on('show.bs.modal', function (event) {
                        const button = $(event.relatedTarget);
                        const itemId = button.data('item-id');
                        const itemName = button.data('item-name');
                                              
                        const modal = $(this);
                        modal.find('#delete-item-name').text(itemName);
                        modal.find('#confirm-delete').attr('href', '{{ route("cart.remove", "") }}/' + itemId);
                    });
                
                    
                // Quantity increase/decrease
                $('.btn-qty.increase').click(function() {
                    const input = $(this).siblings('.qty-input');
                    let value = parseInt(input.val());
                    if (value > 1) {
                        input.val(value - 1);
                        updateQuantity(input);
                    }
                });
                
                $('.btn-qty.decrease').click(function() {
                    const input = $(this).siblings('.qty-input');
                    let value = parseInt(input.val());
                    input.val(value + 1);
                    updateQuantity(input);
                });
                
                $('.qty-input').on('change', function() {
                    updateQuantity($(this));
                });
                
                function updateQuantity(input) {
                    const itemId = input.data('id');
                    const quantity = input.val();
                    
                    $.ajax({
                        url: '{{ route('cart.update') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            item_id: itemId,
                            quantity: quantity
                        },
                        success: function(response) {
                            if (response.success) {
                                // Update all instances of this item's subtotal
                                $(`span.subtotal[data-id="${itemId}"]`).text(response.subtotal);
                                $('.cart-total').text(response.total + ' دينار');
                            } else {
                                // Show error and reset to available quantity
                                alert(response.message);
                                input.val(response.available);
                            }
                        },
                        error: function() {
                            alert('Something went wrong. Please try again.');
                        }
                    });
                }
            });
        </script>
    @endpush
