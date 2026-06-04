<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Models\User;

class CreateTaskAction
{
    use SanitizesTaskDescription;

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(User $user, array $data): Task
    {
        $data['description'] = $this->sanitizeDescription($data['description'] ?? null);

        return $user->tasks()->create($data);
    }
}