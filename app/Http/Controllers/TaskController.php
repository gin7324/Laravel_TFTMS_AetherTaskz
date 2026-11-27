<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => Task::query()
                ->where('is_archived', false)
                ->latest()
                ->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $task = Task::create($this->validatedTask($request));

        return redirect()->route('tasks.show', $task)->with('status', 'Task created.');
    }

    public function show(Task $task): View
    {
        $this->ensureActive($task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $this->ensureActive($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->ensureActive($task);
        $wasDone = $task->status === 'done';
        $task->update($this->validatedTask($request));

        if (! $wasDone && $task->status === 'done') {
            Mail::to(config('tasks.completed_recipient'))->send(new TaskCompleted($task));
        }

        return redirect()->route('tasks.show', $task)->with('status', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->ensureActive($task);
        $task->update(['is_archived' => true]);

        return redirect()->route('tasks.index')->with('status', 'Task archived.');
    }

    private function validatedTask(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'done'])],
        ]);
    }

    private function ensureActive(Task $task): void
    {
        abort_if($task->is_archived, 404);
    }
}
