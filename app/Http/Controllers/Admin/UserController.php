<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\AuditAdminUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminUserRequest;
use App\Http\Requests\Admin\UpdateAdminUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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



    public function store(StoreAdminUserRequest $request, AuditAdminUserAction $audit): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],

        ]);

        if ($request->boolean('is_admin')) {
            $user->promoteToAdmin();
        }

        $audit->record($request->user(), 'admin.user.created', $user, [
            'is_admin' => $user->is_admin,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Usuário {$user->name} criado com sucesso.");
    }

    public function update(UpdateAdminUserRequest $request, User $user, AuditAdminUserAction $audit): RedirectResponse
    {
        $validated = $request->validated();
      
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

        $before = $user->only(['name', 'email', 'is_admin']);


        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->forceFill(['is_admin' => $willBeAdmin]);

        if (! empty($validated['password'])) {
            $user->forceFill(['password' => $validated['password']]);
            
        }

        $changed = array_keys($user->getChanges());
        $passwordIndex = array_search('password', $changed, true);
        if ($passwordIndex !== false) {
            unset($changed[$passwordIndex]);
        }

        $audit->record($request->user(), 'admin.user.updated', $user, [
            'before' => $before,
            'changed' => array_values($changed),
            'password_changed' => ! empty($validated['password']),
        ]);

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Usuário {$user->name} atualizado com sucesso.");
    }

    public function destroy(Request $request, User $user, AuditAdminUserAction $audit): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return back()->withErrors(['user' => 'Você não pode excluir a própria conta enquanto está logado.']);
        }

        if ($user->is_admin && $this->isLastAdmin($user)) {
            return back()->withErrors(['user' => 'Não é possível excluir o último administrador do sistema.']);
        }

        $userName = $user->name;
        $metadata = $user->only(['name', 'email', 'is_admin']);

        $audit->record($request->user(), 'admin.user.deleted', $user, $metadata);


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