<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 text-lg">
                    Selamat datang, {{ Auth::user()->name }}! 👋
                </p>

                {{-- Tambahan tombol logout jika tetap ingin --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
