<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->withCount('tasks')
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'is_admin' => $request->boolean('is_admin'),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Usuário {$user->name} criado com sucesso.");
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $willBeAdmin = $request->boolean('is_admin');

        if ($request->user()->is($user) && $user->is_admin && ! $willBeAdmin) {
            return back()
                ->withInput()
                ->withErrors(['is_admin' => 'Você não pode remover o acesso administrativo da própria conta.']);
        }

        if ($user->is_admin && ! $willBeAdmin && $this->isLastAdmin($user)) {
            return back()
                ->withInput()
                ->withErrors(['is_admin' => 'Não é possível remover o último administrador do sistema.']);
        }

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $willBeAdmin,
        ]);

        if (! empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Usuário {$user->name} atualizado com sucesso.");
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return back()->withErrors(['user' => 'Você não pode excluir a própria conta enquanto está logado.']);
        }

        if ($user->is_admin && $this->isLastAdmin($user)) {
            return back()->withErrors(['user' => 'Não é possível excluir o último administrador do sistema.']);
        }

        $userName = $user->name;

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Usuário {$userName} excluído com sucesso.");
    }

    private function isLastAdmin(User $user): bool
    {
        return User::query()
            ->where('is_admin', true)
            ->whereKeyNot($user->id)
            ->doesntExist();
    }
}