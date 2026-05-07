<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark leading-tight">
            {{ __('Perpenas Link Manager') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-6 bg-white border-b border-gray-light shadow-sm sm:rounded-lg">
                <form action="{{ route('links.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-dark">URL Tujuan (Asli)</label>
                            <input type="url" name="original_url" required 
                                class="mt-1 block w-full border-gray-medium rounded-md shadow-sm focus:ring-brand-red focus:border-brand-red"
                                placeholder="https://google.com/sangat-panjang-sekali">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-dark">Slug (Link Pendek)</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-medium bg-gray-light text-gray-dark text-sm">
                                    {{ request()->getHost() }}/
                                </span>
                                <input type="text" name="slug" required 
                                    class="flex-1 block w-full border-gray-medium rounded-none rounded-r-md focus:ring-brand-red focus:border-brand-red"
                                    placeholder="nama-link">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button class="bg-brand-red hover:bg-brand-red-light">
                            {{ __('Simpan Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-light">
                <div class="p-6 text-dark">
                    <h3 class="text-lg font-bold mb-4">Daftar Link Anda</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-light">
                            <thead class="bg-gray-light">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-dark uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-dark uppercase tracking-wider">URL Asli</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-dark uppercase tracking-wider">Klik</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-dark uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-light">
                                @foreach ($links as $link)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-brand-red">
                                        <a href="{{ route('links.redirect', $link->slug) }}" target="_blank">/{{ $link->slug }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-dark truncate max-w-xs">
                                        {{ $link->original_url }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $link->clicks }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('links.destroy', $link) }}" method="POST" onsubmit="return confirm('Hapus link ini?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>