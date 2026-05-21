<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $baseQuery = $user->is_admin
            ? Task::with('user')
            : $user->tasks()->with('user');

        $tasks = (clone $baseQuery)
            ->latest()
            ->get();

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'completed' => (clone $baseQuery)->where('status', 'concluida')->count(),
            'pending' => (clone $baseQuery)->where('status', 'a_fazer')->count(),
            'doing' => (clone $baseQuery)->where('status', 'fazendo')->count(),
        ];

        return view('tasks.index', compact('tasks', 'stats'));
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('tasks.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'priority' => 'required|in:baixa,media,alta',
            'status' => 'required|in:a_fazer,fazendo,concluida',
            'deadline' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso.');
    }

    public function show(Task $task): RedirectResponse
    {
        $this->authorizeTaskAccess($task);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task): RedirectResponse
    {
        $this->authorizeTaskAccess($task);

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorizeTaskAccess($task);

        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'priority' => 'required|in:baixa,media,alta',
            'status' => 'required|in:a_fazer,fazendo,concluida',
            'deadline' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorizeTaskAccess($task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa removida com sucesso.');
    }

    private function authorizeTaskAccess(Task $task): void
    {
        $user = auth()->user();

        if (! $user->is_admin && $task->user_id !== $user->id) {
            abort(403);
        }
    }
}