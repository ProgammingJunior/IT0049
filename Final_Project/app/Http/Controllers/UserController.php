<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class UserController extends Controller {
    public function index(Request $request): View {
        $items=User::when($request->filled('search'),function($q)use($request):void{$term='%'.trim((string)$request->input('search')).'%';$q->where(fn($x)=>$x->where('full_name','like',$term)->orWhere('email','like',$term)->orWhere('username','like',$term));})->withCount('sales')->orderBy('full_name')->paginate(10)->withQueryString();
        return view('records.index',['kind'=>'staff','items'=>$items]);
    }
    public function create(): View { return view('records.form',['kind'=>'staff','item'=>new User()]); }
    public function store(Request $request): RedirectResponse {
        $data=$request->validate(['username'=>['required','string','max:50','alpha_dash','unique:users,username'],'full_name'=>['required','string','max:100'],'email'=>['required','email','max:255','unique:users,email'],'password'=>['required','confirmed','min:8'],'avatar'=>['nullable','image','mimes:jpg,jpeg,png,webp','max:2048']]);
        unset($data['avatar']); if($request->hasFile('avatar'))$data['avatar']=$this->avatar($request); User::create($data);
        return redirect()->route('users.index')->with('success','Staff account created.');
    }
    public function show(User $user): View { return view('records.show',['kind'=>'staff','item'=>$user->loadCount('sales')]); }
    public function edit(User $user): View { return view('records.form',['kind'=>'staff','item'=>$user]); }
    public function update(Request $request, User $user): RedirectResponse {
        $data=$request->validate(['username'=>['required','string','max:50','alpha_dash',Rule::unique('users','username')->ignore($user->id)],'full_name'=>['required','string','max:100'],'email'=>['required','email','max:255',Rule::unique('users','email')->ignore($user->id)],'password'=>['nullable','confirmed','min:8'],'avatar'=>['nullable','image','mimes:jpg,jpeg,png,webp','max:2048']]);
        if(blank($data['password']??null))unset($data['password']); unset($data['avatar']);
        if($request->hasFile('avatar')){$path=$this->avatar($request);if($user->avatar)Storage::disk('public')->delete($user->avatar);$data['avatar']=$path;}
        $user->update($data); return redirect()->route('users.show',$user)->with('success','Staff profile saved.');
    }
    public function destroy(User $user): RedirectResponse {
        if($user->is(auth()->user()))return back()->with('error','The signed-in account cannot be removed.');
        if($user->sales()->exists())return back()->with('error','Staff with recorded sales cannot be removed.');
        if($user->avatar)Storage::disk('public')->delete($user->avatar);$user->delete();
        return redirect()->route('users.index')->with('success','Staff account removed.');
    }
    private function avatar(Request $request): string {
        $jpg=(new ImageManager(new Driver()))->read($request->file('avatar')->getPathname())->scaleDown(width:512,height:512)->toJpeg(85);
        $path='avatars/'.Str::uuid().'.jpg';Storage::disk('public')->put($path,(string)$jpg);return $path;
    }
}
