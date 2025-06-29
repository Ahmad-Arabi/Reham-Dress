<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['colors', 'sizes', 'images']);

        // فلترة حسب اللون
        if ($request->filled('color')) {
            $query->whereHas('colors', function($q) use ($request) {
                $q->where('color', $request->color);
            });
        }
        // فلترة حسب العمر
        if ($request->filled('age')) {
            $query->whereHas('sizes', function($q) use ($request) {
                $q->where('age', $request->age);
            });
        }
        // فلترة حسب السعر الأدنى
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        // فلترة حسب السعر الأقصى
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        // فلترة حسب التوفر
        if ($request->filled('in_stock')) {
            if ($request->in_stock == '1') {
                $query->where('stock', '>', 0);
            } elseif ($request->in_stock == '0') {
                $query->where('stock', '<=', 0);
            }
        }

        $products = $query->orderByDesc('updated_at')->paginate(12);
        $colors = Color::select('color')->distinct()->pluck('color');
        $ages = Size::select('age')->distinct()->pluck('age');

        return view('user.shop', compact('products', 'colors', 'ages'));
    }
}