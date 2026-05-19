<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // LISTAR TASKS
    public function index()
    {
            // Usuário logado
    $user = auth()->user();

    // Se for admin
        if ($user->is_admin) {

            $tasks = Task::with('user')->get();

        } else {

            // Usuário comum
            $tasks = $user->tasks;

        }

        return view('tasks.index', compact('tasks'));
            
    }

    // FORMULÁRIO DE CRIAÇÃO
    public function create()
    {
        return view('tasks.create');
    }

    // SALVAR TASK
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => 'required|min:3|max:255',

            'description' => 'nullable|max:1000',

            'priority' => 'required|in:baixa,media,alta',

            'status' => 'required|in:a_fazer,fazendo,concluida',

            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->back()->with('success', 'Task criada com sucesso!');
    }

    // ATUALIZAR TASK
    public function update(Request $request, Task $task)
    {
        // Segurança
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        // Validação
        $validated = $request->validate([

            'title' => 'required|min:3|max:255',

            'description' => 'nullable|max:1000',

            'priority' => 'required|in:baixa,media,alta',

            'status' => 'required|in:a_fazer,fazendo,concluida',

            'deadline' => 'nullable|date|after_or_equal:today',
        ]);
       

        // Atualizar task
        $task->update($validated);

        return redirect()->back()->with('success', 'Task atualizada com sucesso!');
        }

    // DELETAR TASK

    public function destroy(Task $task)
    {
        // Segurança
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        // Deletar task
        $task->delete();

        return redirect()->back()->with('success', 'Task removida com sucesso!');
    }

    public function complete(Task $task)
    {
        // Segurança
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        // Atualizar status
        $task->update([
            'status' => 'concluida'
        ]);

        return redirect()->back()->with('success', 'Task concluída com sucesso!');
    }

    public function dashboard()
    {
        $user = auth()->user();

        // Admin
        if ($user->is_admin) {

            $query = Task::query();

        } else {

            // Usuário comum
            $query = $user->tasks();
        }

        // Métricas
        $totalTasks = $query->count();

        $completedTasks = (clone $query)
            ->where('status', 'concluida')
            ->count();

        $pendingTasks = (clone $query)
            ->where('status', 'a_fazer')
            ->count();

        $doingTasks = (clone $query)
            ->where('status', 'fazendo')
            ->count();

        $highPriorityTasks = (clone $query)
            ->where('priority', 'alta')
            ->count();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'doingTasks',
            'highPriorityTasks'
        ));
    }
}