<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $status = $request->string('status')->toString();
        $sort = $request->string('sort')->toString();

        $tasks = $user->tasks()
            ->when($request->filled('search'), fn ($query) => $query->where('title', 'like', '%'.$request->string('search')->toString().'%'))
            ->when(in_array($status, ['a_fazer', 'fazendo', 'concluida'], true), fn ($query) => $query->where('status', $status))
            ->when($sort === 'old', fn ($query) => $query->oldest(), fn ($query) => $query->latest())
            ->paginate(20)
            ->withQueryString();

        $stats = $user->tasks()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'concluida' THEN 1 ELSE 0 END) as completed")
            ->selectRaw("SUM(CASE WHEN status = 'a_fazer' THEN 1 ELSE 0 END) as pending")
            ->selectRaw("SUM(CASE WHEN status = 'fazendo' THEN 1 ELSE 0 END) as doing")
            ->first()
            ->toArray();

        return view('tasks.index', compact('tasks', 'stats'));
    }

        public function store(StoreTaskRequest $request, CreateTaskAction $action): RedirectResponse
        {
            $action->execute($request->user(), $request->validated());
      

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa criada com sucesso.');
    }
    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $action): RedirectResponse
    {
        Gate::authorize('update', $task);

        $action->execute($task, $request->validated());
     

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(Task $task): JsonResponse
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function toggle(Task $task): JsonResponse
    {
        Gate::authorize('update', $task);

        $task->status = $task->status === 'concluida'
            ? 'a_fazer'
            : 'concluida';

        $task->save();

        return response()->json([
            'success' => true,
            'status' => $task->status,
        ]);
    }

    public function inlineUpdate(Request $request, Task $task): JsonResponse
    {
        Gate::authorize('update', $task);

         $validated = $request->validate([
            'field' => ['required', Rule::in(['title', 'status', 'priority', 'deadline'])],
            'value' => ['nullable'],
         ]);

         $rules = [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['required', Rule::in(['a_fazer', 'fazendo', 'concluida'])],
            'priority' => ['required', Rule::in(['baixa', 'media', 'alta'])],
            'deadline' => ['nullable', 'date'],
        ];

        $value = validator(
            ['value' => $validated['value']],
            ['value' => $rules[$validated['field']]]
        )->validate()['value'];


        $task->update([$validated['field'] => $value]);

        return response()->json([
            'success' => true,
        ]);
    }
}