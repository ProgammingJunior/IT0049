<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\View\View;
class PageController extends Controller {
    public function home(): View { return view('pages.home'); }
    public function dashboard(): View {
        return view('dashboard', [
            'productCount'=>Product::where('is_archived',false)->count(),
            'customerCount'=>Customer::count(), 'staffCount'=>User::count(),
            'todayRevenue'=>Sale::whereDate('created_at',today())->sum('total_price'),
            'recentSales'=>Sale::with(['product','customer','staff'])->latest()->take(5)->get(),
            'lowStock'=>Product::where('is_archived',false)->where('stock_quantity','<=',5)->orderBy('stock_quantity')->take(5)->get(),
        ]);
    }
}
