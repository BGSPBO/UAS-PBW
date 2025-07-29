<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg">
                <span class="text-2xl">📋</span>
            </div>
            <h2
                class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Daftar Tugas
            </h2>
        </div>
    </x-slot>

    <style>
        .task-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-modern {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(226, 232, 240, 0.5);
            transition: all 0.3s ease;
        }

        .form-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .btn-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-success-modern {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .btn-success-modern:hover {
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .reminder-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-left: 4px solid #f59e0b;
            animation: pulse-warning 2s infinite;
        }

        @keyframes pulse-warning {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }

        .section-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 250, 252, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
            border: 1px solid rgba(226, 232, 240, 0.5);
        }

        .pending-task {
            background: linear-gradient(135deg, rgba(254, 226, 226, 0.5) 0%, rgba(255, 255, 255, 0.8) 100%);
            border-left: 4px solid #ef4444;
        }

        .completed-task {
            background: linear-gradient(135deg, rgba(220, 252, 231, 0.5) 0%, rgba(247, 254, 231, 0.8) 100%);
            border-left: 4px solid #10b981;
        }

        .delegated-task {
            background: linear-gradient(135deg, rgba(219, 234, 254, 0.5) 0%, rgba(233, 246, 254, 0.8) 100%);
            border-left: 4px solid #3b82f6;
        }

        .priority-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .priority-penting {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .priority-agak-penting {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .priority-tidak-penting {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .user-tag {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .floating-form {
            position: sticky;
            top: 20px;
            z-index: 10;
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, transparent);
            border: none;
            margin: 24px 0;
        }
    </style>

    {{-- Form Tambah Tugas --}}
    <div class="floating-form">
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 p-6 rounded-2xl task-card shadow-lg">
            @csrf
            <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center">
                <span class="text-xl mr-2">✨</span>
                Tambah Tugas Baru
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <input type="text" name="title" class="form-modern rounded-xl shadow-sm border-0 px-4 py-3"
                    placeholder="Judul tugas" required>
                <input type="date" name="due_date" class="form-modern rounded-xl shadow-sm border-0 px-4 py-3" required>
                <select name="priority" class="form-modern rounded-xl shadow-sm border-0 px-4 py-3">
                    <option value="penting">🔥 Penting</option>
                    <option value="agak penting">⚡ Agak Penting</option>
                    <option value="tidak penting">📝 Tidak Penting</option>
                </select>
                <select name="assigned_to" class="form-modern rounded-xl shadow-sm border-0 px-4 py-3">
                    <option value="">👤 Delegasikan ke (opsional)</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button class="btn-modern text-white px-6 py-3 rounded-xl font-semibold relative overflow-hidden">
                    <span class="relative z-10">➕ Tambah</span>
                </button>
            </div>
        </form>
    </div>

    <hr class="divider">

    {{-- Reminder H-3 --}}
    @if ($reminders->count())
        <div class="reminder-card text-yellow-800 p-6 mb-6 rounded-2xl shadow-lg">
            <div class="flex items-center space-x-3">
                <span class="text-3xl">⏰</span>
                <div>
                    <strong class="text-lg">Reminder Penting!</strong>
                    <p class="mt-1">Ada <span class="font-bold text-xl">{{ $reminders->count() }}</span> tugas yang tinggal
                        H-3!</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Tugas Belum Selesai --}}
    <div class="section-header">
        <h3 class="text-xl font-bold text-gray-700 flex items-center">
            <span class="text-2xl mr-3">❌</span>
            Tugas Belum Selesai
            <span class="ml-auto bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                {{ count($pending) }}
            </span>
        </h3>
    </div>

    <ul class="mb-8 space-y-4">
        @foreach ($pending as $task)
            <li class="task-card pending-task p-6 rounded-2xl shadow-lg">
                <form action="{{ route('tasks.update', $task) }}" method="POST"
                    class="space-y-4 md:space-x-4 md:space-y-0 md:flex items-center">
                    @csrf
                    @method('PUT')
                    <div class="flex-1">
                        <input type="text" name="title" value="{{ $task->title }}"
                            class="form-modern rounded-xl w-full px-4 py-3 font-semibold">
                    </div>
                    <input type="date" name="due_date" value="{{ $task->due_date }}"
                        class="form-modern rounded-xl px-4 py-3">
                    <select name="priority" class="form-modern rounded-xl px-4 py-3">
                        <option value="penting" {{ $task->priority == 'penting' ? 'selected' : '' }}>🔥 Penting</option>
                        <option value="agak penting" {{ $task->priority == 'agak penting' ? 'selected' : '' }}>⚡ Agak Penting
                        </option>
                        <option value="tidak penting" {{ $task->priority == 'tidak penting' ? 'selected' : '' }}>📝 Tidak
                            Penting</option>
                    </select>
                    <button
                        class="btn-modern btn-success-modern text-white px-6 py-3 rounded-xl font-semibold relative overflow-hidden">
                        <span class="relative z-10">✅ Selesai</span>
                    </button>
                </form>

                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="priority-badge priority-{{ str_replace(' ', '-', $task->priority) }}">
                            {{ $task->priority }}
                        </span>
                        <span class="user-tag">
                            👤 {{ $task->owner->name }}
                        </span>
                        @if ($task->assignee)
                            <span class="user-tag" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                                📨 {{ $task->assignee->name }}
                            </span>
                        @endif
                    </div>
                    <span class="text-sm text-gray-500 font-medium">
                        📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                    </span>
                </div>
            </li>
        @endforeach
    </ul>

    {{-- Tugas Selesai --}}
    <div class="section-header">
        <h3 class="text-xl font-bold text-gray-700 flex items-center">
            <span class="text-2xl mr-3">✅</span>
            Tugas Selesai
            <span class="ml-auto bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                {{ count($completed) }}
            </span>
        </h3>
    </div>

    <ul class="mb-8 space-y-4">
        @forelse ($completed as $task)
            <li class="task-card completed-task p-6 rounded-2xl shadow-lg opacity-75">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="font-bold text-lg text-gray-700 line-through">{{ $task->title }}</h4>
                        <div class="mt-3 flex items-center space-x-3">
                            <span class="priority-badge priority-{{ str_replace(' ', '-', $task->priority) }}">
                                {{ $task->priority }}
                            </span>
                            <span class="user-tag">
                                👤 {{ $task->owner->name }}
                            </span>
                            @if ($task->assignee)
                                <span class="user-tag" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                                    📨 {{ $task->assignee->name }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="text-sm text-gray-500 font-medium block mb-2">
                            📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                        </span>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline text-sm">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            </li>
        @empty
            <li class="task-card p-8 rounded-2xl shadow-lg text-center">
                <div class="text-gray-400">
                    <span class="text-4xl block mb-3">🎉</span>
                    <p class="text-lg font-medium">Belum ada tugas yang diselesaikan.</p>
                    <p class="text-sm mt-1">Selesaikan tugas untuk melihat daftar di sini.</p>
                </div>
            </li>
        @endforelse
    </ul>

    {{-- Tugas Didelegasikan ke Saya --}}
    <div class="section-header">
        <h3 class="text-xl font-bold text-gray-700 flex items-center">
            <span class="text-2xl mr-3">📨</span>
            Tugas Didelegasikan ke Saya
            <span class="ml-auto bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                {{ count($delegatedToMe) }}
            </span>
        </h3>
    </div>

    <ul class="space-y-4">
        @forelse ($delegatedToMe as $task)
            <li class="task-card delegated-task p-6 rounded-2xl shadow-lg">
                <form action="{{ route('tasks.update', $task) }}" method="POST"
                    class="space-y-4 md:space-x-4 md:space-y-0 md:flex items-center">
                    @csrf
                    @method('PUT')
                    <div class="flex-1">
                        <input type="text" name="title" value="{{ $task->title }}"
                            class="form-modern rounded-xl w-full px-4 py-3 font-semibold">
                    </div>
                    <input type="date" name="due_date" value="{{ $task->due_date }}"
                        class="form-modern rounded-xl px-4 py-3">
                    <select name="priority" class="form-modern rounded-xl px-4 py-3">
                        <option value="penting" {{ $task->priority == 'penting' ? 'selected' : '' }}>🔥 Penting</option>
                        <option value="agak penting" {{ $task->priority == 'agak penting' ? 'selected' : '' }}>⚡ Agak Penting
                        </option>
                        <option value="tidak penting" {{ $task->priority == 'tidak penting' ? 'selected' : '' }}>📝 Tidak
                            Penting</option>
                    </select>
                    <button
                        class="btn-modern btn-success-modern text-white px-6 py-3 rounded-xl font-semibold relative overflow-hidden">
                        <span class="relative z-10">✅ Selesai</span>
                    </button>
                </form>

                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="priority-badge priority-{{ str_replace(' ', '-', $task->priority) }}">
                            {{ $task->priority }}
                        </span>
                        <span class="user-tag">
                            👤 {{ $task->owner->name }}
                        </span>
                        @if ($task->assignee)
                            <span class="user-tag" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                                📨 {{ $task->assignee->name }}
                            </span>
                        @endif
                    </div>
                    <span class="text-sm text-gray-500 font-medium">
                        📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                    </span>
                </div>
            </li>
        @empty
            <li class="task-card p-8 rounded-2xl shadow-lg text-center">
                <div class="text-gray-400">
                    <span class="text-4xl block mb-3">🎉</span>
                    <p class="text-lg font-medium">Tidak ada tugas yang didelegasikan ke kamu.</p>
                    <p class="text-sm mt-1">Selamat! Kamu bebas tugas delegasi saat ini.</p>
                </div>
            </li>
        @endforelse
    </ul>
</x-layouts.app>