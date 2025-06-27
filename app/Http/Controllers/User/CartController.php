<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public $cookieExpiraton = 1440; // 1 day in minutes
    

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
     * Save cart items back to cookie
     */
    private function saveCartToCookie($userCartItems)
    {
        // Get all cart items from cookie
        $cartJson = Cookie::get('cart', json_encode([]));
        $allCartItems = json_decode($cartJson, true);
        
        // Remove old items for current user
        $currentUserId = Auth::id();
        foreach ($allCartItems as $itemId => $item) {
            if (isset($item['user_id']) && $item['user_id'] == $currentUserId) {
                unset($allCartItems[$itemId]);
            }
        }
        
        // Add updated user items
        $allCartItems = array_merge($allCartItems, $userCartItems);
        
        // Save back to cookie
        Cookie::queue('cart', json_encode($allCartItems), $this->cookieExpiraton);
        
    }
    
    /**
     * Display the cart contents
     */
    public function index()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لكي تتمكن من عرض السلة الخاصة بك');
        }
        
        $cartItems = $this->getUserCartItems();
        $totalPrice = $this->calculateTotal($cartItems);
        return view('user.cart', compact('cartItems', 'totalPrice'));
    }

    /**
     * Add a product to the cart
     */
    public function addToCart(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لكي تتمكن من إضافة المنتج إلى السلة');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|exists:sizes,id',
            'color' => 'required|exists:colors,id',

        ]);

            
        
        try {
            // Get product
            $product = Product::findOrFail($request->product_id);
            $productSize = Size::findOrFail($request->size);
            $productColor = Color::findOrFail($request->color);

            // Check if product is active
            // if (!$product->isActive) {
            //     return back()->with('error', 'المنتج غير متوفر حالياً');
            // }
            
            // Check stock availability
            if ($product->stock < $request->quantity) {
                return back()->with('error', 'المخزون غير كافٍ للمقاس المختار');
            }
            
            
            // Generate a unique cart item ID
            $cartItemId = uniqid();
            
            // Prepare cart item data with user ID
            $cartItem = [
                'id' => $cartItemId,
                'user_id' => Auth::id(), // Add user ID to cart item
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'size_id' => $productSize->id,
                'size' => $productSize->age,
                'color_id' => $productColor->id ?? null,
                'color' => $productColor->color ?? null,
                'image' => $product->thumbnail ?? 'images/fallback.jpg',
                'subtotal' => $product->price * $request->quantity,
            ];
            
            // Get current user's cart items
            $userCartItems = $this->getUserCartItems();
            
            // Add item to user's cart
            $userCartItems[$cartItemId] = $cartItem;
            
            // Save cart to cookie
            $this->saveCartToCookie($userCartItems);
            
            Log::info('Item added to cart', ['user' => Auth::id(), 'product' => $product->id]);
            
            // if($request->action_type == "buyNow") {
            //     return redirect()->route('checkout');
            // } else {

            //     return redirect()->back()->with('success', 'تم إضافة المنتح إلى السلة');
            // }
            return redirect()->route('cart.index')->with('success', 'تم إضافة المنتح إلى السلة');

        } catch (\Exception $e) {
            Log::error('Error adding item to cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'يرجى التأكد من تحديد الخيارات المطلوبة.');
        }
    }

    /**
     * Update the quantity of a cart item
     */
    public function updateQuantity(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'يرجى تسجيل الدخول']);
        }
        
        $request->validate([
            'item_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $userCartItems = $this->getUserCartItems();
        
        if (isset($userCartItems[$request->item_id])) {
            // Verify this item belongs to the current user
            if ($userCartItems[$request->item_id]['user_id'] != Auth::id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized']);
            }
            
            // Get product size to check stock
            // $productSize = Size::find($userCartItems[$request->item_id]['size_id']);
            
            // if ($productSize && $request->quantity > $productSize->stock) {
            //     return response()->json([
            //         'success' => false, 
            //         'message' => 'Not enough stock available',
            //         'available' => $productSize->stock
            //     ]);
            // }
            
            // Update quantity and subtotal
            $userCartItems[$request->item_id]['quantity'] = $request->quantity;
            $userCartItems[$request->item_id]['subtotal'] = $userCartItems[$request->item_id]['price'] * $request->quantity;
            
            // Save updated cart
            $this->saveCartToCookie($userCartItems);
            $totalPrice = $this->calculateTotal($userCartItems);
            
            return response()->json([
                'success' => true,
                'subtotal' => number_format($userCartItems[$request->item_id]['subtotal'], 2),
                'total' => number_format($totalPrice, 2)
            ]);
        }
        
        return response()->json(['success' => false, 'message' => 'لم يتم العثور على المنتج المطلوب']);
    }

    /**
     * Remove an item from the cart
     */
    public function removeItem($itemId)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لكي تتمكن من تعديل السلة');
        }
        
        $userCartItems = $this->getUserCartItems();

        if (isset($userCartItems[$itemId])) {
            // Verify this item belongs to the current user
            if ($userCartItems[$itemId]['user_id'] != Auth::id()) {
                return redirect()->route('cart.index')->with('error', 'Unauthorized action');
            }
            
            unset($userCartItems[$itemId]);
            $this->saveCartToCookie($userCartItems);
            
            return redirect()->route('cart.index')->with('success', 'تمت إزالة المنتج من سلة التسوق بنجاح!');
        }
        
        return redirect()->route('cart.index')->with('error', 'لم يتم العثور على المنتج في سلة التسوق');
    }
    
    /**
     * Clear the entire cart for current user
     */
    public function clearCart()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يرجى تسجيل الدخول لكي تتمكن من عرض السلة');
        }
        
        // Clear only current user's cart items
        $this->saveCartToCookie([]);
        
        return redirect()->route('cart.index')->with('success', 'تم إفراغ السلة بنجاح!');
    }
    
    /**
     * Calculate total price of items in cart
     */
    private function calculateTotal($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['subtotal'];
        }
        return $total;
    }
}