<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{

    private function getUserCartItems()
    {
        $cartJson = Cookie::get('cart', json_encode([]));
        $allCartItems = json_decode($cartJson, true);
        
        // Filter items for current user
        $userCartItems = [];
        $currentUserId = Auth::id();
        
        if ($currentUserId) {
            foreach ($allCartItems as $itemId => $item) {
                if (isset($item['user_id']) && $item['user_id'] == $currentUserId) {
                    $userCartItems[$itemId] = $item;
                }
            }
        }
        
        return $userCartItems;
    }
    
    /**
     * Show the checkout page
     */
    public function index()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لإتمام الطلب');
        }
        
        // Get user-specific cart items
        $cartItems = $this->getUserCartItems();
        
        // If cart is empty, redirect to cart page
        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('info', 'سلة المشتريات الخاصة بك فارغة.  يرجى إضافة بعض المنتجات قبل إتمام الطلب.');
        }
        
        // Get user details
        $user = Auth::user();
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['subtotal'];
        }
        
        // Session variables for order information
        $discount = session('checkout.discount', 0);
        $appliedCoupon = session('checkout.coupon');
        $totalPrice = $subtotal - $discount;

        $shippingFees = 3.00;
        $totalPrice += $shippingFees;

        // if ($totalPrice < 50) {
        //     $shippingFees = 5.00;
        //     $totalPrice += $shippingFees;
        // } else {
        //     $shippingFees = "Free";
        // }
        
        return view('user.checkout', compact(
            'cartItems', 
            'subtotal', 
            'discount', 
            'totalPrice', 
            'user',
            'appliedCoupon',
            'shippingFees'
        ));
    }
    
    /**
     * Apply a coupon code to the order
     */
    public function applyCoupon(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لتطبيق الكوبون');
        }
        
        $request->validate([
            'coupon_code' => 'required|string|max:50'
        ], ['coupon_code.required' => 'يرجى إدخال رمز الكوبون']);
        
        $code = $request->coupon_code;
        $now = now();
        
        // Find the coupon
        $coupon = Coupon::where('code', $code)
            ->where('isFeatured', 1)
            ->where('start_date', '<=', $now)
            ->where('expiry_date', '>=', $now)
            ->first();
        
        if (!$coupon) {
            return back()->with('error', ' الكوبون غير صحيح أو منتهي الصلاحية!');
        }
        
        // Get user-specific cart items
        $cartItems = $this->getUserCartItems();
        
        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['subtotal'];
        }
        
        // Calculate discount
        $discount = $coupon->discount;

        
        // Store discount and coupon in session
        session(['checkout.discount' => $discount]);
        session(['checkout.coupon' => [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $coupon->discount,
        ]]);
        
        return back()->with('success', 'تم تطبيق الكوبون بنجاح!');
    }
    
    /**
     * Remove applied coupon
     */
    public function removeCoupon()
    {
        session()->forget('checkout.discount');
        session()->forget('checkout.coupon');
        
        return back()->with('success', 'تمت إزالة الكوبون بنجاح!');
    }
    
    /**
     * Process and store the order
     */
    public function placeOrder(Request $request)
    {
        // Check user 
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لإتمام الطلب');
        }
        
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'payment_method' => 'required|in:COD,credi_card'
        ],  [
                'address.required' => 'يرجى إدخال عنوان التسليم',
                'phone.required' => 'يرجى إدخال رقم الهاتف',
                'phone.max' => 'يرجى إدخال رقم هاتف لا يتجاوز 10 أرقام',
            ]);
        // dd($request->stripeToken);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Get cart items
        $cartItems = $this->getUserCartItems();
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('info', 'سلة المشتريات الخاصة بك فارغة.  يرجى إضافة بعض المنتجات قبل إتمام الطلب.');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['subtotal'];
        }
        
        // Get applied coupon
        $discount = session('checkout.discount', 0);
        $appliedCoupon = session('checkout.coupon');
        $totalPrice = $subtotal - $discount;

        $shippingFees = 3.00;
        $totalPrice += $shippingFees;

        // if ($totalPrice < 50) {
        //     $shippingFees = 5.00;
        //     $totalPrice += $shippingFees;
        // } else {
        //     $shippingFees = "Free";
        // }
        

        try {
            
            // Create the order

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalPrice,
                'status' => 'pending',
                'address' => $request->address,
                'phone' => $request->phone,
                'coupon_id' => $appliedCoupon['id'] ?? null,
                'discount_amount' => $discount,
                'payment_method' => $request->payment_method,
            ]);
            
            // Add each item to the order
            foreach ($cartItems as $item) {
                
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'color' => $item['color'],
                    'age' => $item['size'],
                ]);
                 
            }

    
            $this->clearUserCart();
            session()->forget('checkout');
            
            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'تم إنشاء طلبك بنجاح!');
                
        } catch (\Exception $e) {
            return back()->with('error', 'حدثت مشكلة أثناء معالجة طلبك. يرجى المحاولة مرة أخرى');
        }
    }
    

    private function clearUserCart()
    {
        $cartJson = Cookie::get('cart', json_encode([]));
        $allCartItems = json_decode($cartJson, true);
        
        // Remove items for current user only
        $currentUserId = Auth::id();
        foreach ($allCartItems as $itemId => $item) {
            if (isset($item['user_id']) && $item['user_id'] == $currentUserId) {
                unset($allCartItems[$itemId]);
            }
        }
        
        // Save back to cookie
        Cookie::queue('cart', json_encode($allCartItems), 1440);
    }
    
}