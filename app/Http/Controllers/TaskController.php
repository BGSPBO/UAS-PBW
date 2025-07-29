<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $myTasks = Task::with(['owner', 'assignee'])
            ->where('user_id', Auth::id())
            ->orderBy('due_date')
            ->get();

        $delegatedToMe = Task::with(['owner', 'assignee'])
            ->where('assigned_to', Auth::id())
            ->where('user_id', '!=', Auth::id())
            ->orderBy('due_date')
            ->get();

        $reminders = $myTasks->filter(function ($task) {
            $due = Carbon::parse($task->due_date)->startOfDay();
            $today = Carbon::now()->startOfDay();
            $selisih = $today->diffInDays($due, false); // false biar minus kalau sudah lewat
            return !$task->is_done && $selisih >= 1 && $selisih <= 3;
        });

        $completed = Task::with(['owner', 'assignee'])
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhere('assigned_to', Auth::id());
            })
            ->where('is_done', true)
            ->orderBy('due_date')
            ->get();
        $pending = $myTasks->where('is_done', false);

        $users = User::all();

        return view('tasks.index', compact(
            'myTasks',
            'delegatedToMe',
            'completed',
            'pending',
            'reminders',
            'users'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Task::create([
            'title' => $validated['title'],
            'due_date' => $validated['due_date'],
            'priority' => $validated['priority'],
            'is_done' => false,
            'user_id' => Auth::id(),
            'assigned_to' => $validated['assigned_to'] ?? null,
        ]);

        return redirect()->back()->with('status', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|string',
        ]);

        $task->update($validated + ['is_done' => true]);

        return redirect()->back()->with('status', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        if (Auth::id() === $task->user_id || Auth::id() === $task->assigned_to) {
            $task->delete();
            return redirect()->back()->with('status', 'Tugas berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Kamu tidak punya izin untuk menghapus tugas ini.');
    }
}
