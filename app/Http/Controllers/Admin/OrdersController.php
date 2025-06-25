<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use PHPUnit\Event\TestSuite\Loaded;

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

    public function show(Request $request, Order $order) {
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


    
        return view('admin.orders.show', compact('orders'));
    
    }

    public function create() {
        

        return view('admin.coupons.create');

    }


    public function store(Request $request) {

        $validatedData = $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
            'isFeatured' => 'required|boolean',
        ], [
            'code.required' => 'يرجى إدخال كود الخصم',
            'code.unique' => 'كود الخصم موجود بالفعل',
            'discount.required' => 'يرجى إدخال قيمة الخصم',
            'start_date.required' => 'يرجى إدخال تاريخ البدء',
            'expiry_date.required' => 'يرجى إدخال تاريخ الانتهاء',
            'isFeatured.required' => 'يرجى تحديد حالة الكوبون',
        ]);

        Order::create($validatedData); // Save the order
        return redirect()->route('admin.coupons.index')->with('success', 'تم إنشاء الكوبون بنجاح!');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        // Fallback: Return a full view if the request is not AJAX (optional)
        return view('admin.coupons.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'code' => ['required','string', 'unique:' . Order::class . ',code,' . $id],
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date',
            'isFeatured' => 'required|boolean',
        ], [
            'code.required' => 'يرجى إدخال كود الكوبون',
            'code.unique' => 'كود الخصم موجود بالفعل',
            'discount.required' => 'يرجى إدخال قيمة الخصم',
            'start_date.required' => 'يرجى إدخال تاريخ البدء',
            'expiry_date.required' => 'يرجى إدخال تاريخ الانتهاء',
            'isFeatured.required' => 'يرجى تحديد حالة الكوبون',
        ]);

        $order = Order::findOrFail($id);

        $order->update($validatedData);
        return redirect()->route('admin.coupons.index')->with('success', 'تم تحديث الكوبون بنجاح!');
    }
}