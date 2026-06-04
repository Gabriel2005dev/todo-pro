<?php

namespace App\Actions\Admin;

use App\Models\AuditLog;
use App\Models\User;

class AuditAdminUserAction
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function record(User $actor, string $action, User $subject, array $metadata = []): void
    {
        AuditLog::record($actor, $action, $subject, $metadata);
    }
}