<?php

namespace App\Http\Controllers\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index()
  {
    $featuredProducts = Product::with(['colors', 'sizes'])
        ->latest() // same as orderBy('created_at', 'desc')
        ->take(3)
        ->get();

    return view('user.welcome', compact('featuredProducts'));
}
}