<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();
        $users = User::query()->orderBy('id', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.users.form', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $data = $this->validated($request, null);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.users.index')->with('ok', 'Kullanıcı oluşturuldu.');
    }

    public function edit(User $user)
    {
        $this->authorizeAdmin();
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeAdmin();
        $data = $this->validated($request, $user->id);
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('admin.users.index')->with('ok', 'Kullanıcı güncellendi.');
    }

    public function destroy(User $user)
    {
        $this->authorizeAdmin();
        abort_if($user->id === auth()->id(), 403, 'Kendinizi silemezsiniz.');
        $user->delete();
        return redirect()->route('admin.users.index')->with('ok', 'Kullanıcı silindi.');
    }

    private function authorizeAdmin(): void
    {
        abort_unless(auth()->user()?->isAdmin(), 403, 'Bu işlem için yönetici yetkisi gerekir.');
    }

    private function validated(Request $request, ?int $userId): array
    {
        return $request->validate([
            'username'  => ['required', 'string', 'min:3', 'max:50', Rule::unique('users', 'username')->ignore($userId)],
            'name'      => ['required', 'string', 'max:120'],
            'email'     => ['required', 'email', 'max:180', Rule::unique('users', 'email')->ignore($userId)],
            'role'      => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_EDITOR])],
            'is_active' => ['required', 'boolean'],
            'password'  => [$userId ? 'nullable' : 'required', 'string', 'min:8'],
        ]);
    }
}
