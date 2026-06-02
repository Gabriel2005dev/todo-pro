<?php
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('user:make-admin {email}', function (string $email) {
    $user = User::query()
        ->where('email', $email)
        ->first();

    if (! $user) {
        $this->error("Nenhum usuário encontrado com o e-mail {$email}.");

        return 1;
    }

    $user->forceFill(['is_admin' => true])->save();

    $this->info("Usuário {$user->email} agora é administrador.");

    return 0;
})->purpose('Transforma um usuário existente em administrador pelo e-mail');