<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('colors', 'sizes', 'images')->orderBy('updated_at', 'desc')->paginate(7);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'colors' => 'nullable|string',  // نص، مفصول بفواصل
            'sizes' => 'nullable|string',   // نص، مفصول بفواصل
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'الاسم مطلوب.',
            'description.required' => 'الوصف مطلوب.',
            'price.required' => 'السعر مطلوب.',
            'stock.required' => 'المخزون مطلوب.',
            'thumbnail.image' => 'الصورة الرئيسية يجب أن تكون من نوع صورة.',
            'thumbnail.mimes' => 'الصورة الرئيسية يجب أن تكون من نوع jpg, jpeg, png, أو gif.',
            'thumbnail.max' => 'حجم الصورة الرئيسية يجب أن لا يتجاوز 2 ميجابايت.',
            'images.*.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'images.*.mimes' => 'الصورة يجب أن تكون من نوع jpg, jpeg, png, أو gif.',
            'images.*.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            'colors.string' => 'الألوان يجب أن تكون نصاً مفصولاً بفواصل.',
            'sizes.string' => 'الأحجام يجب أن تكون نصاً مفصولاً بفواصل.',
        ]);

        // Handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }

        // أنشئ المنتج أولاً
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'thumbnail' => $thumbnailPath,
        ]);

        // التعامل مع الألوان
        $colors = array_filter(array_map('trim', explode(',', $request->input('colors', ''))));
        foreach ($colors as $color) {
            Color::create(['product_id' => $product->id, 'color' => $color]);
        }

        // التعامل مع الأحجام (الأعمار)
        $sizes = array_filter(array_map('trim', explode(',', $request->input('sizes', ''))));
        foreach ($sizes as $size) {
            Size::create(['product_id' => $product->id, 'age' => $size]);
        }

        // التعامل مع الصور الإضافية
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images/' . $product->id, 'public');
                ProductImage::create(['product_id' => $product->id, 'path' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'تمت إضافة المنتج بنجاح');
    }

    public function edit(Product $product)
    {
        $product->load('colors', 'sizes', 'images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'colors' => 'nullable|string', // نص مفصول بفواصل
            'sizes' => 'nullable|string',  // نص مفصول بفواصل
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'الاسم مطلوب.',
            'description.required' => 'الوصف مطلوب.',
            'price.required' => 'السعر مطلوب.',
            'stock.required' => 'المخزون مطلوب.',
            'images.*.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'images.*.mimes' => 'الصورة يجب أن تكون من نوع jpg, jpeg, png, أو gif.',
            'images.*.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            'colors.string' => 'الألوان يجب أن تكون نصاً مفصولاً بفواصل.',
            'sizes.string' => 'الأحجام يجب أن تكون نصاً مفصولاً بفواصل.',
            'thumbnail.image' => 'الصورة الرئيسية يجب أن تكون من نوع صورة.',
            'thumbnail.mimes' => 'الصورة الرئيسية يجب أن تكون من نوع jpg, jpeg, png, أو gif.',
            'thumbnail.max' => 'حجم الصورة الرئيسية يجب أن لا يتجاوز 2 ميجابايت.',
        ]);

        // Prepare update data
        $updateData = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ];

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // احذف الصورة القديمة إذا كانت موجودة
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // خزّن الصورة الجديدة
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails/' . $product->id, 'public');
            $updateData['thumbnail'] = $thumbnailPath;
        }

        // حدّث بيانات المنتج الأساسية
        $product->update($updateData);

        // حذف الألوان القديمة وإضافة الجديدة
        $product->colors()->delete();
        $colors = array_filter(array_map('trim', explode(',', $request->input('colors', ''))));
        foreach ($colors as $color) {
            Color::create(['product_id' => $product->id, 'color' => $color]);
        }

        // حذف الأحجام القديمة وإضافة الجديدة
        $product->sizes()->delete();
        $sizes = array_filter(array_map('trim', explode(',', $request->input('sizes', ''))));
        foreach ($sizes as $size) {
            Size::create(['product_id' => $product->id, 'age' => $size]);
        }

        // إضافة الصور الجديدة إذا وُجدت
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images/' . $product->id, 'public');
                ProductImage::create(['product_id' => $product->id, 'path' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }

    // New method to delete all images for a product
    public function deleteAllImages(Product $product)
    {
        // Delete all additional images from storage and database
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $product->images()->delete();

        // Delete thumbnail if exists
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
            $product->update(['thumbnail' => null]);
        }

        return redirect()->back()->with('success', 'تم حذف جميع صور المنتج بنجاح');
    }

    public function deleteConfirm(Product $product)
    {
        return view('admin.products.delete', compact('product'));
    }

    public function destroy(Product $product)
    {
        // Delete thumbnail if exists
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        // Delete all additional images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        // حذف جميع البيانات المرتبطة أولاً
        $product->colors()->delete();
        $product->sizes()->delete();
        $product->images()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}