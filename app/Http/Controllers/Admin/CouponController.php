<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(Request $request) {
        $query = Coupon::query();

        if ($request->has('search')) {
            $query->where('code', 'LIKE', "%{$request->search}%");
        }

        if ($request->has('status')) {
            $query->where('isFeatured', $request->status);
        }


        $coupons = $query->orderBy('updated_at', 'desc')->paginate(7);


    
        return view('admin.coupons.index', compact('coupons'));
    
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

        Coupon::create($validatedData); // Save the coupon
        return redirect()->route('admin.coupons.index')->with('success', 'تم إنشاء الكوبون بنجاح!');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        // Fallback: Return a full view if the request is not AJAX (optional)
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'code' => ['required','string', 'unique:' . Coupon::class . ',code,' . $id],
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

        $coupon = Coupon::findOrFail($id);

        $coupon->update($validatedData);
        return redirect()->route('admin.coupons.index')->with('success', 'تم تحديث الكوبون بنجاح!');
    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);


        return view('admin.coupons.delete', compact('coupon'));
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'تم حذف الكوبون بنجاح!');
    }
}