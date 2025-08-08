<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        // Ambil semua kategori untuk form dan filter
        $categories = Category::all();

        // Mulai query untuk tasks
        $query = Task::where('user_id', $userId)
            ->where('status', 'belum_selesai');

        // Logic Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Logic Filter Kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Ambil hasil query untuk tasks
        $tasks = $query->orderBy('created_at', 'desc')->get();

        // Tugas yang sudah selesai
        $completedTasks = Task::where('user_id', $userId)
            ->where('status', 'selesai')
            ->get();

        // Reminder H-3 & H-1
        $reminderTasks = Task::where('user_id', $userId)
            ->where('status', 'belum_selesai')
            ->whereIn('due_date', [
                Carbon::now()->addDays(3)->format('Y-m-d'),
                Carbon::now()->addDay()->format('Y-m-d')
            ])
            ->get();

        // Tugas yang didelegasikan ke user
        $delegatedTasks = Task::where('assigned_to', $userId)
            ->where('status', 'belum_selesai')
            ->get();

        // Semua user untuk dropdown assign (kecuali diri sendiri)
        $users = User::where('id', '!=', $userId)->get();

        return view('tasks.index', compact(
            'tasks',
            'completedTasks',
            'reminderTasks',
            'delegatedTasks',
            'users',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
            'priority'    => 'required|string|in:penting,agak penting,tidak penting',
            'category_id' => 'required|exists:categories,id',
            'attachment'  => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $task = new Task();
        $task->title       = $request->title;
        $task->description = $request->description;
        $task->due_date    = $request->due_date;
        $task->priority    = $request->priority;
        $task->status      = 'belum_selesai';
        $task->user_id     = auth()->id();
        $task->assigned_to = $request->assigned_to;
        $task->category_id = $request->category_id;

        // Simpan file ke folder public/storage/attachments
        if ($request->hasFile('attachment')) {
            $task->attachment = $request->file('attachment')->store('attachments', 'public');
        }

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'due_date'    => 'required|date',
            'priority'    => 'required|string|in:penting,agak penting,tidak penting',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'attachment'  => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->assigned_to = $request->assigned_to;
        $task->category_id = $request->category_id;

        // Simpan file jika ada
        if ($request->hasFile('attachment')) {
            // Hapus file lama jika ada
            if ($task->attachment) {
                Storage::disk('public')->delete($task->attachment);
            }
            $task->attachment = $request->file('attachment')->store('attachments', 'public');
        }

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function markComplete($id)
    {
        // Perbaikan: Mencari tugas berdasarkan user_id ATAU assigned_to
        $task = Task::where('id', $id)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                      ->orWhere('assigned_to', auth()->id());
            })->firstOrFail();

        $task->status = 'selesai';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas telah diselesaikan.');
    }

    public function destroy($id)
    {
        // Perbaikan: Mencari tugas berdasarkan user_id ATAU assigned_to
        $task = Task::where('id', $id)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                      ->orWhere('assigned_to', auth()->id());
            })->firstOrFail();
        
        // Hapus file lampiran jika ada
        if ($task->attachment) {
            Storage::delete($task->attachment);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function exportPdf()
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        $pdf = Pdf::loadView('tasks.export_pdf', ['tasks' => $tasks]);
        return $pdf->download('daftar-tugas-' . now()->format('Ymd_His') . '.pdf');
    }
}
