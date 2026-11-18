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

class UserController extends Controller
{
    public function index(): View
    {
        return view('users.index', ['users' => User::query()->orderBy('full_name')->get()]);
    }

    public function create(): View
    {
        return view('users.create', ['user' => new User()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $data['password'] = $data['password'];
        User::create($data);

        return redirect()->route('users.index')->with('success', 'User account created.');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }
        unset($data['avatar']);

        if ($request->hasFile('avatar')) {
            $prepared = (new ImageManager(new Driver()))
                ->read($request->file('avatar')->getPathname())
                ->scaleDown(width: 512, height: 512)
                ->toJpeg(85);
            $path = 'avatars/' . Str::uuid() . '.jpg';
            Storage::disk('public')->put($path, (string) $prepared);

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->route('users.show', $user)->with('success', 'User account updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) {
            return redirect()->route('users.show', $user)->with('error', 'You cannot delete the account you are using.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User account deleted.');
    }
}
