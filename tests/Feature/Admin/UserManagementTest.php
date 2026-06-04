<?php



use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('blocks non admin users from the users crud', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('admin.users.index'))
        ->assertForbidden();
});

it('allows admins to list and create users', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertOk()
        ->assertSee('Administração de usuários');

    $this->post(route('admin.users.store'), [
        'name' => 'Novo Admin',
        'email' => 'novo-admin@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'is_admin' => '1',
    ])->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'email' => 'novo-admin@example.com',
        'is_admin' => true,
    ]);
});

it('allows admins to update users and protects their own admin access', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $anotherAdmin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($admin)
        ->put(route('admin.users.update', $user), [
            'name' => 'Usuário Editado',
            'email' => 'editado@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
            'current_admin_password' => 'password',
            'is_admin' => '1',
        ])->assertRedirect(route('admin.users.index'));

    $user->refresh();

    expect($user->name)->toBe('Usuário Editado')
        ->and($user->is_admin)->toBeTrue()
        ->and(Hash::check('new-password', $user->password))->toBeTrue();

    $this->put(route('admin.users.update', $admin), [
        'name' => $admin->name,
        'email' => $admin->email,
    ])->assertSessionHasErrors('is_admin');

    expect($admin->refresh()->is_admin)->toBeTrue();

    $this->put(route('admin.users.update', $anotherAdmin), [
        'name' => $anotherAdmin->name,
        'email' => $anotherAdmin->email,
    ])->assertRedirect(route('admin.users.index'));

    expect($anotherAdmin->refresh()->is_admin)->toBeFalse();

    $this->put(route('admin.users.update', $user), [
        'name' => $user->name,
        'email' => $user->email,
    ])->assertRedirect(route('admin.users.index'));

    expect($user->refresh()->is_admin)->toBeFalse();
});

it('does not allow an admin to delete their own account', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $admin))
        ->assertSessionHasErrors('user');

    $this->assertDatabaseHas('users', [
        'id' => $admin->id,
    ]);
});

it('keeps task access restricted to the task owner even for admins', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $owner = User::factory()->create(['is_admin' => false]);

     $adminTask = $admin->tasks()->create([
        'title' => 'Tarefa do admin',
        'description' => 'Visível apenas para o admin dono',
        'priority' => 'media',
        'status' => 'a_fazer',
       
    ]);

     $otherTask = $owner->tasks()->create([
        'title' => 'Tarefa de outro usuário',
        'description' => 'Não deve aparecer para admin',
        'priority' => 'alta',
        'status' => 'fazendo',
     
    ]);

    $this->actingAs($admin)
        ->get(route('tasks.index'))
        ->assertOk()
        ->assertSee($adminTask->title)
        ->assertDontSee($otherTask->title);

    $this->patch(route('tasks.toggle', $otherTask))
        ->assertForbidden();
});