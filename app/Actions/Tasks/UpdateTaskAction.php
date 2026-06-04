<?php

namespace App\Actions\Tasks;

use App\Models\Task;

class UpdateTaskAction
{
    use SanitizesTaskDescription;

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(Task $task, array $data): Task
    {
        $data['description'] = $this->sanitizeDescription($data['description'] ?? null);
        $task->update($data);

        return $task->refresh();
    }
}