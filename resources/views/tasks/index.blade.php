<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg">
                <span class="text-2xl">📋</span>
            </div>
            <!-- Tombol Export PDF -->
            <a href="{{ route('tasks.exportPdf') }}" class="btn btn-success mb-3">
                Export PDF
            </a>

            <form action="{{ route('tasks.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari tugas..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>

            <h2
                class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Daftar Tugas
            </h2>
        </div>
    </x-slot>

    <style>
        /* Gaya CSS dari kode Anda sebelumnya */
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

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-md" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Form Tambah Tugas --}}
    <div class="floating-form">
        <!-- Form Tambah Tugas -->
        <form id="task-form" action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data"
            class="mb-4 form-modern p-6 rounded-2xl shadow-lg">
            @csrf
            <h3 class="text-xl font-bold text-gray-700 mb-4">Tambahkan Tugas Baru</h3>
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                    <input type="text" name="title" id="title" class="form-modern rounded-xl w-full px-4 py-3 mt-1"
                        required>
                    <div id="title-error" class="text-red-500 text-sm mt-1 hidden">Judul tugas tidak boleh kosong.</div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description"
                        class="form-modern rounded-xl w-full px-4 py-3 mt-1"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Tenggat Waktu</label>
                        <input type="date" name="due_date" id="due_date"
                            class="form-modern rounded-xl w-full px-4 py-3 mt-1" required>
                        <div id="due_date-error" class="text-red-500 text-sm mt-1 hidden">Tenggat waktu harus diisi.
                        </div>
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas</label>
                        <select name="priority" id="priority" class="form-modern rounded-xl w-full px-4 py-3 mt-1">
                            <option value="tidak penting">📝 Tidak Penting</option>
                            <option value="agak penting">⚡ Agak Penting</option>
                            <option value="penting">🔥 Penting</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" class="form-modern rounded-xl w-full px-4 py-3 mt-1"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div id="category_id-error" class="text-red-500 text-sm mt-1 hidden">Kategori harus diisi.</div>
                    </div>

                    <div>
                        <label for="assigned_to" class="block text-sm font-medium text-gray-700">Delegasikan ke</label>
                        <select name="assigned_to" id="assigned_to"
                            class="form-modern rounded-xl w-full px-4 py-3 mt-1">
                            <option value="">-- Pilih Pengguna --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="attachment" class="block text-sm font-medium text-gray-700">Lampiran</label>
                    <input type="file" name="attachment" id="attachment"
                        class="form-modern rounded-xl w-full px-4 py-3 mt-1">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="btn-modern text-white px-6 py-3 rounded-xl font-semibold relative overflow-hidden w-full">
                    <span class="relative z-10">Tambah Tugas</span>
                </button>
            </div>
        </form>
    </div>

    <hr class="divider">

    {{-- Pencarian dan Filter --}}
    <div class="section-header flex flex-col md:flex-row items-center justify-between">
        <form action="{{ route('tasks.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
                <input type="text" name="search" placeholder="Cari judul atau deskripsi..."
                    class="form-modern rounded-xl px-4 py-3 w-full md:w-80" value="{{ request('search') }}">
                <select name="category" class="form-modern rounded-xl px-4 py-3 w-full md:w-48">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="btn-modern text-white px-6 py-3 rounded-xl font-semibold w-full md:w-auto">Cari &
                    Filter</button>
            </div>
        </form>
    </div>

    <hr class="divider">

    {{-- Reminder H-3 --}}
    @if ($reminderTasks->count())
        <div class="reminder-card text-yellow-800 p-6 mb-6 rounded-2xl shadow-lg">
            <div class="flex items-center space-x-3">
                <span class="text-3xl">⏰</span>
                <div>
                    <strong class="text-lg">Reminder Penting!</strong>
                    <p class="mt-1">Ada <span class="font-bold text-xl">{{ $reminderTasks->count() }}</span> tugas yang
                        tinggal
                        H-3!</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Tugas Belum Selesai --}}
    <div class="section-header">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-700 flex items-center">
                <span class="text-2xl mr-3">❌</span>
                Tugas Belum Selesai
                <span class="ml-auto bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ count($tasks) }}
                </span>
            </h3>
            <a href="{{ route('tasks.exportPdf') }}" class="btn-modern text-white px-4 py-2 rounded-xl font-semibold">
                Export PDF
            </a>
        </div>
    </div>

    <ul class="mb-8 space-y-4">
        @foreach ($tasks as $task)
            <li class="task-card pending-task p-6 rounded-2xl shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h4 class="font-bold text-lg text-gray-800">{{ $task->title }}</h4>
                        @if($task->description)
                            <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                        @endif
                        @if ($task->attachment)
                            <a href="{{ Storage::url($task->attachment) }}" target="_blank"
                                class="text-blue-500 hover:underline text-sm mt-2 block">
                                <i class="fas fa-paperclip"></i> Lihat Lampiran
                            </a>
                        @endif
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <span class="text-sm text-gray-500 font-medium">
                            📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Form untuk memperbarui detail tugas --}}
                <form action="{{ route('tasks.update', $task) }}" method="POST"
                    class="space-y-4 md:space-x-4 md:space-y-0 md:flex items-center" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- ... (input fields) ... -->
                    <input type="text" name="title" value="{{ $task->title }}"
                        class="form-modern rounded-xl w-full px-4 py-3 font-semibold">
                    <input type="date" name="due_date" value="{{ $task->due_date }}"
                        class="form-modern rounded-xl px-4 py-3">
                    <select name="priority" class="form-modern rounded-xl px-4 py-3">
                        <option value="penting" {{ $task->priority == 'penting' ? 'selected' : '' }}>🔥 Penting</option>
                        <option value="agak penting" {{ $task->priority == 'agak penting' ? 'selected' : '' }}>⚡ Agak Penting
                        </option>
                        <option value="tidak penting" {{ $task->priority == 'tidak penting' ? 'selected' : '' }}>📝 Tidak
                            Penting</option>
                    </select>
                    <select name="category_id" class="form-modern rounded-xl w-full px-4 py-3 mt-1">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="btn-modern text-white px-6 py-3 rounded-xl font-semibold relative overflow-hidden">
                        <span class="relative z-10">💾 Update</span>
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
                        @if ($task->category)
                            <span class="user-tag">
                                🏷️ {{ $task->category->name }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-3">
                        {{-- Form untuk menyelesaikan tugas --}}
                        <form action="{{ route('tasks.markComplete', $task) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn-modern btn-success-modern text-white px-4 py-2 rounded-xl font-semibold relative overflow-hidden">
                                <span class="relative z-10">✅ Selesai</span>
                            </button>
                        </form>
                    </div>
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
                {{ count($completedTasks) }}
            </span>
        </h3>
    </div>

    <ul class="mb-8 space-y-4">
        @forelse ($completedTasks as $task)
            <li class="task-card completed-task p-6 rounded-2xl shadow-lg opacity-75">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="font-bold text-lg text-gray-700 line-through">{{ $task->title }}</h4>
                        @if($task->description)
                            <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                        @endif
                        @if($task->attachment)
                            <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank">Lihat Lampiran</a>
                        @endif
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
                {{ count($delegatedTasks) }}
            </span>
        </h3>
    </div>

    <ul class="space-y-4">
        @forelse ($delegatedTasks as $task)
            <li class="task-card delegated-task p-6 rounded-2xl shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h4 class="font-bold text-lg text-gray-800">{{ $task->title }}</h4>
                        @if($task->description)
                            <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                        @endif
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <span class="text-sm text-gray-500 font-medium">
                            📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                        </span>
                    </div>
                </div>

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
                        @if ($task->category)
                            <span class="user-tag">
                                🏷️ {{ $task->category->name }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-3">
                        {{-- Form untuk menyelesaikan tugas yang didelegasikan --}}
                        <form action="{{ route('tasks.markComplete', $task) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn-modern btn-success-modern text-white px-4 py-2 rounded-xl font-semibold relative overflow-hidden">
                                <span class="relative z-10">✅ Selesai</span>
                            </button>
                        </form>
                    </div>
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

    {{-- Script untuk Validasi Client-side --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('task-form');
            form.addEventListener('submit', function (event) {
                let isValid = true;
                const titleInput = document.getElementById('title');
                const dueDateInput = document.getElementById('due_date');
                const categoryInput = document.getElementById('category_id');

                // Validasi Judul
                if (titleInput.value.trim() === '') {
                    isValid = false;
                    document.getElementById('title-error').classList.remove('hidden');
                } else {
                    document.getElementById('title-error').classList.add('hidden');
                }

                // Validasi Tanggal
                if (dueDateInput.value.trim() === '') {
                    isValid = false;
                    document.getElementById('due_date-error').classList.remove('hidden');
                } else {
                    document.getElementById('due_date-error').classList.add('hidden');
                }

                // Validasi Kategori
                if (categoryInput.value === '') {
                    isValid = false;
                    document.getElementById('category_id-error').classList.remove('hidden');
                } else {
                    document.getElementById('category_id-error').classList.add('hidden');
                }

                if (!isValid) {
                    event.preventDefault(); // Mencegah form terkirim
                    alert('Harap lengkapi semua field yang diperlukan!');
                }
            });
        });
    </script>
</x-layouts.app>