<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->get();
        $roles = User::roleOptions();
        $roleLabels = User::roleLabels();

        return view('admin.users.index', compact('users', 'roles', 'roleLabels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|in:' . implode(',', User::roleOptions()),
            'password' => 'required|string|min:3|confirmed',
        ]);

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun baru berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        $roles = User::roleOptions();
        $roleLabels = User::roleLabels();

        return view('admin.users.edit', compact('user', 'roles', 'roleLabels'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:' . implode(',', User::roleOptions()),
            'password' => 'nullable|string|min:3|confirmed',
        ]);

        if (
            $user->role === User::ROLE_ADMIN &&
            $validated['role'] !== User::ROLE_ADMIN &&
            $this->isLastAdmin($user)
        ) {
            return back()
                ->withInput()
                ->with('error', 'Admin terakhir tidak boleh diubah ke role lain.');
        }

        if (blank($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data akun berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Akun yang sedang dipakai tidak bisa dihapus.');
        }

        if ($user->role === User::ROLE_ADMIN && $this->isLastAdmin($user)) {
            return back()->with('error', 'Admin terakhir tidak boleh dihapus.');
        }

        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus.');
    }

    private function isLastAdmin(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN
            && User::admins()->count() === 1;
    }
}
