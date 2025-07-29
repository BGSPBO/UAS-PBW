<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Update Profil --}}
            <div class="p-6 bg-white shadow-md rounded-xl">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Informasi Akun
                    </h3>
                    <p class="text-sm text-gray-500">
                        Perbarui nama, email, dan informasi umum akun kamu.
                    </p>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Ganti Password --}}
            <div class="p-6 bg-white shadow-md rounded-xl">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Ganti Password
                    </h3>
                    <p class="text-sm text-gray-500">
                        Pastikan akun kamu menggunakan password yang panjang dan acak.
                    </p>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Hapus Akun --}}
            <div class="p-6 bg-white shadow-md rounded-xl">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-red-600">
                        Hapus Akun
                    </h3>
                    <p class="text-sm text-gray-500">
                        Setelah akun dihapus, semua data akan hilang secara permanen.
                    </p>
                </div>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-layouts.app>
