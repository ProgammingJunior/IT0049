<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class ProductController extends Controller {
    public function index(Request $request): View {
        $archived = $request->boolean('archived');
        $products = Product::query()->where('is_archived', $archived)
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%'.trim((string) $request->input('search')).'%'))
            ->withCount('sales')->orderBy('name')->paginate(10)->withQueryString();
        return view('records.index', ['kind' => 'products', 'items' => $products, 'archived' => $archived]);
    }
    public function create(): View { return view('records.form', ['kind' => 'products', 'item' => new Product()]); }
    public function store(Request $request): RedirectResponse {
        $data = $this->validatedData($request); $data['image'] = $this->storeImage($request); Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product added to inventory.');
    }
    public function show(Product $product): View { return view('records.show', ['kind' => 'products', 'item' => $product->loadCount('sales')->loadSum('sales', 'quantity')]); }
    public function edit(Product $product): View { return view('records.form', ['kind' => 'products', 'item' => $product]); }
    public function update(Request $request, Product $product): RedirectResponse {
        $data = $this->validatedData($request);
        if ($request->hasFile('image')) { $new = $this->storeImage($request); if ($product->image) Storage::disk('public')->delete($product->image); $data['image'] = $new; }
        $product->update($data);
        return redirect()->route('products.show', $product)->with('success', 'Product details saved.');
    }
    public function archive(Product $product): RedirectResponse { $product->update(['is_archived' => true]); return redirect()->route('products.index')->with('success', 'Product archived. Sales remain in history.'); }
    public function restore(Product $product): RedirectResponse { $product->update(['is_archived' => false]); return redirect()->route('products.index', ['archived' => 1])->with('success', 'Product restored.'); }
    private function validatedData(Request $request): array {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'], 'price' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
            'stock_quantity' => ['required', 'integer', 'min:0', 'max:1000000'], 'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
    private function storeImage(Request $request): ?string {
        if (!$request->hasFile('image')) return null;
        $jpg = (new ImageManager(new Driver()))->read($request->file('image')->getPathname())->scaleDown(width: 900, height: 900)->toJpeg(86);
        $path = 'products/'.Str::uuid().'.jpg'; Storage::disk('public')->put($path, (string) $jpg); return $path;
    }
}
