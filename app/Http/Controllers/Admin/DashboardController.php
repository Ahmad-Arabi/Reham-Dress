<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::whereIn('status', ['delivered', 'shipped'])->sum('total_amount');
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalCoupons = \App\Models\Coupon::count();

        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($order) {
                switch ($order->status) {
                    case 'pending':
                        $order->status_text = 'قيد الانتظار';
                        $order->status_bg = 'bg-warning';
                        $order->status_color = 'text-dark';
                        break;
                    case 'processing':
                        $order->status_text = 'قيد المعالجة';
                        $order->status_bg = 'bg-info';
                        $order->status_color = 'text-dark';
                        break;
                    case 'shipped':
                        $order->status_text = 'تم الشحن';
                        $order->status_bg = 'bg-primary';
                        $order->status_color = 'text-white';
                        break;
                    case 'delivered':
                        $order->status_text = 'تم التوصيل';
                        $order->status_bg = 'bg-success';
                        $order->status_color = 'text-white';
                        break;
                    default:
                        $order->status_text = 'ملغي';
                        $order->status_bg = 'bg-secondary';
                        $order->status_color = 'text-white';
                }
                return $order;
            });

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalUsers',
            'recentOrders',
            'totalCoupons'
        ));
    }
}
