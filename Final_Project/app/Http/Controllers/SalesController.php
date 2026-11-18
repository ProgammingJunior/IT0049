<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
class SalesController extends Controller {
    public function index(Request $request): View {
        $sales = Sale::with(['product', 'customer', 'staff'])->when($request->filled('search'), function ($q) use ($request): void {
            $term = '%'.trim((string) $request->input('search')).'%';
            $q->whereHas('product', fn ($x) => $x->where('name', 'like', $term))
                ->orWhereHas('customer', fn ($x) => $x->where('full_name', 'like', $term))
                ->orWhereHas('staff', fn ($x) => $x->where('full_name', 'like', $term));
        })->latest()->paginate(12)->withQueryString();
        return view('sales.index', ['sales' => $sales, 'revenue' => Sale::sum('total_price')]);
    }
    public function create(): View {
        return view('sales.create', ['products' => Product::where('is_archived', false)->where('stock_quantity', '>', 0)->orderBy('name')->get(), 'customers' => Customer::orderBy('full_name')->get()]);
    }
    public function store(Request $request): RedirectResponse {
        $data = $request->validate(['product_id' => ['required', 'integer', 'exists:products,id'], 'customer_id' => ['nullable', 'integer', 'exists:customers,id'], 'quantity' => ['required', 'integer', 'min:1', 'max:1000000']]);
        $sale = DB::transaction(function () use ($data): Sale {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']); $quantity = (int) $data['quantity'];
            if ($product->is_archived) throw ValidationException::withMessages(['product_id' => 'This product is archived and cannot be sold.']);
            if ($quantity > $product->stock_quantity) throw ValidationException::withMessages(['quantity' => 'Only '.$product->stock_quantity.' units are currently in stock.']);
            $totalCents = (int) round((float) $product->price * 100) * $quantity; $product->decrement('stock_quantity', $quantity);
            return Sale::create(['product_id' => $product->id, 'customer_id' => $data['customer_id'] ?: null, 'sold_by' => auth()->id(), 'quantity' => $quantity, 'total_price' => number_format($totalCents / 100, 2, '.', '')]);
        });
        return redirect()->route('sales.show', $sale)->with('success', 'Sale recorded and inventory updated.');
    }
    public function show(Sale $sale): View { return view('sales.show', ['sale' => $sale->load(['product', 'customer', 'staff'])]); }
}
