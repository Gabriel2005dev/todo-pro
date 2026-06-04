<?php

namespace App\Actions\Tasks;

trait SanitizesTaskDescription
{
    protected function sanitizeDescription(?string $description): ?string
    {
        if ($description === null) {
            return null;
        }

        $description = trim(strip_tags($description));

        return $description === '' ? null : $description;
    }
}