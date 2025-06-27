<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use PHPUnit\Event\TestSuite\Loaded;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(Request $request, Order $order) {
        $query = Order::query()->with(['user', 'products', 'products.colors', 'products.sizes', 'orderItems']);

        if ($request->has('search')) {
            $query->where('id', 'LIKE', "%{$request->search}%")->orWhere('phone', 'LIKE', "%{$request->search}%")  
            ->orWhereHas('user', function ($q) use ($request) {
                $q->Where('email', 'LIKE', "%{$request->search}%");
            });
        }
        
        if ($request->has('email')) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }


        $orders = $query->orderBy('created_at', 'desc')->paginate(7);


    
        return view('admin.orders.index', compact('orders'));
    
    }

    public function show($id) {
        $order = Order::with(['user', 'products', 'products.colors', 'products.sizes', 'orderItems'])->findOrFail($id);

    
        return view('admin.orders.show', compact('order'));
    
    }


    public function edit($id)
    {
        $order = Order::findOrFail($id);

        // Fallback: Return a full view if the request is not AJAX (optional)
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tracking' => 'nullable|string|max:255',
            'phone' => 'required|string|max:10',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'address' => 'required|string|max:255',
        ], [
            'phone.required' => 'يرجى إدخال رقم الهاتف',
            'phone.max' => 'رقم الهاتف يجب أن لا يتجاوز 10 أرقام',
            'tracking.max' => 'رقم التتبع يجب أن لا يتجاوز 255 حرفًا',
            'status.required' => 'يرجى تحديد حالة الطلب',
            'address.required' => 'يرجى إدخال عنوان الشحن',
        ]);


        $validatedItemsData = $request->validate([
            'order_items' => 'required|array',
            'order_items.*.id' => 'required|exists:order_items,id',
            'order_items.*.color' => 'required|string|max:25',
            'order_items.*.age' => 'required|string|max:255',
        ], [
            'order_items.required' => 'يرجى إدخال تفاصيل المنتجات في الطلب',
            'order_items.*.color.required' => 'يرجى إدخال اللون لجميع المنتجات في الطلب',
            'order_items.*.age.required' => 'يرجى إدخال المقاس لجميع المنتجات في الطلب',
            'order_items.*.color.max' => 'اللون يجب أن لا يتجاوز 25 حرفًا',
            'order_items.*.age.max' => 'المقاس يجب أن لا يتجاوز 255 حرفًا',
        ]);

        foreach ($validatedItemsData['order_items'] as $itemData) {
            $item = OrderItem::findOrFail($itemData['id']);
            $item->update([
                'color' => $itemData['color'],
                'age' => $itemData['age'],
            ]);
        }

        $order = Order::findOrFail($id);
        $order->update($validatedData);

        return redirect()->route('admin.orders.index')->with('success', 'تم تحديث الطلب بنجاح!');
    }
}