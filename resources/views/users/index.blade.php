<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-bold text-2xl text-dark leading-tight tracking-tight">
                {{ __('Manajemen User') }}
            </h2>
            <p class="text-sm text-gray-dark">
                Kelola anggota dan hak akses pengguna sistem.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- FORM CARD -->
            <div class="relative overflow-hidden bg-white border border-gray-light shadow-lg rounded-3xl">

                <!-- Accent -->
                <div class="absolute inset-x-0 top-0 h-1 bg-brand-red"></div>

                <div class="p-6 md:p-8">
                    <section class="max-w-2xl">

                        <header class="mb-6">
                            <h2 class="text-lg font-bold text-dark">
                                Daftarkan Anggota Baru
                            </h2>

                            <p class="mt-1 text-sm text-gray-dark">
                                Email yang didaftarkan akan bisa login melalui Google.
                            </p>
                        </header>

                        <form method="post" action="{{ route('users.store') }}" class="space-y-6">
                            @csrf

                            <!-- NAME -->
                            <div>
                                <label class="block text-sm font-semibold text-dark mb-2">
                                    Nama
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    required
                                    class="block w-full rounded-2xl border border-gray-light bg-white px-4 py-3 text-sm text-dark shadow-sm transition focus:border-brand-red focus:ring-2 focus:ring-brand-red-light focus:outline-none"
                                />
                            </div>

                            <!-- EMAIL -->
                            <div>
                                <label class="block text-sm font-semibold text-dark mb-2">
                                    Email Google
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    class="block w-full rounded-2xl border border-gray-light bg-white px-4 py-3 text-sm text-dark shadow-sm transition focus:border-brand-red focus:ring-2 focus:ring-brand-red-light focus:outline-none"
                                />
                            </div>

                            <!-- ROLE -->
                            <div>
                                <label class="block text-sm font-semibold text-dark mb-2">
                                    Role
                                </label>

                                <select
                                    name="is_admin"
                                    id="is_admin"
                                    class="block w-full rounded-2xl border border-gray-light bg-white px-4 py-3 text-sm text-dark shadow-sm transition focus:border-brand-red focus:ring-2 focus:ring-brand-red-light focus:outline-none"
                                >
                                    <option value="0">Pengguna Biasa</option>
                                    <option value="1">Administrator</option>
                                </select>
                            </div>

                            <!-- BUTTON -->
                            <div class="flex items-center justify-end">
                                <x-primary-button class="px-6 py-3 rounded-2xl bg-brand-red hover:bg-brand-red-light text-white shadow-md transition-all duration-200 hover:shadow-lg">
                                    {{ __('Daftarkan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="bg-white border border-gray-light shadow-lg rounded-3xl overflow-hidden">

                <!-- HEADER -->
                <div class="flex items-center justify-between px-6 md:px-8 py-5 border-b border-gray-light bg-white">
                    <div>
                        <h3 class="text-lg font-bold text-dark">
                            Daftar Pengguna
                        </h3>

                        <p class="text-sm text-gray-dark mt-1">
                            Pengguna yang memiliki akses ke sistem.
                        </p>
                    </div>

                    <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-light text-sm font-medium text-gray-dark">
                        Total :
                        <span class="text-brand-red font-bold">
                            {{ $users->total() }}
                        </span>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-light">

                        <thead class="bg-gray-light/40">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Nama
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Email
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Role
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-light bg-white">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-light/20 transition duration-150">

                                <!-- NAME -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="font-semibold text-dark">
                                        {{ $user->name }}
                                    </div>
                                </td>

                                <!-- EMAIL -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-dark">
                                        {{ $user->email }}
                                    </div>
                                </td>

                                <!-- ROLE -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                        {{ $user->is_admin 
                                            ? 'bg-brand-red text-white' 
                                            : 'bg-gray-light text-gray-dark' }}">
                                        {{ $user->is_admin ? 'Admin' : 'Pengguna' }}
                                    </span>
                                </td>

                                <!-- ACTION -->
                                <td class="px-6 py-5 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- TOGGLE ROLE -->
                                        <form method="POST" action="{{ route('users.update', $user) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-light text-gray-dark hover:bg-gray-light transition-all duration-200"
                                                title="Tukar Role"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- DELETE -->
                                        <form
                                            method="POST"
                                            action="{{ route('users.destroy', $user) }}"
                                            onsubmit="return confirm('Hapus user ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-light text-brand-red hover:bg-brand-red hover:text-white transition-all duration-200"
                                                title="Hapus User"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="px-6 py-5 border-t border-gray-light bg-white">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>