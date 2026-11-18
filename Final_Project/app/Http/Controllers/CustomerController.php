<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
class CustomerController extends Controller {
    public function index(Request $request): View {
        $items = Customer::when($request->filled('search'), function ($q) use ($request): void { $term='%'.trim((string)$request->input('search')).'%'; $q->where(fn($x)=>$x->where('full_name','like',$term)->orWhere('email','like',$term)); })->withCount('sales')->orderBy('full_name')->paginate(10)->withQueryString();
        return view('records.index', ['kind'=>'customers','items'=>$items]);
    }
    public function create(): View { return view('records.form',['kind'=>'customers','item'=>new Customer()]); }
    public function store(Request $request): RedirectResponse { Customer::create($this->data($request)); return redirect()->route('customers.index')->with('success','Customer added.'); }
    public function show(Customer $customer): View { return view('records.show',['kind'=>'customers','item'=>$customer->loadCount('sales')]); }
    public function edit(Customer $customer): View { return view('records.form',['kind'=>'customers','item'=>$customer]); }
    public function update(Request $request, Customer $customer): RedirectResponse { $customer->update($this->data($request,$customer)); return redirect()->route('customers.show',$customer)->with('success','Customer details saved.'); }
    public function destroy(Customer $customer): RedirectResponse { $customer->delete(); return redirect()->route('customers.index')->with('success','Customer removed; previous sales are retained.'); }
    private function data(Request $request, ?Customer $customer=null): array { return $request->validate(['full_name'=>['required','string','max:100'],'email'=>['required','email','max:100',Rule::unique('customers','email')->ignore($customer?->id)],'phone'=>['nullable','string','max:20']]); }
}
