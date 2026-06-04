<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->index(['user_id', 'status', 'created_at'], 'tasks_user_status_created_at_index');
            $table->index(['user_id', 'deadline'], 'tasks_user_deadline_index');
            $table->index(['user_id', 'priority'], 'tasks_user_priority_index');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('tasks_user_status_created_at_index');
            $table->dropIndex('tasks_user_deadline_index');
            $table->dropIndex('tasks_user_priority_index');
        });
    }
};