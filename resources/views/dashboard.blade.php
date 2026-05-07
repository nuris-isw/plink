<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-bold text-2xl text-dark leading-tight tracking-tight">
                {{ __('Perpenas Link Manager') }}
            </h2>
            <p class="text-sm text-gray-dark">
                Kelola short link dan QR Code dengan tampilan yang lebih modern & profesional.
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
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-dark">
                            Buat Link Baru
                        </h3>
                        <p class="text-sm text-gray-dark mt-1">
                            Tambahkan URL tujuan dan custom slug untuk menghasilkan short link.
                        </p>
                    </div>

                    <form action="{{ route('links.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                            <!-- URL -->
                            <div>
                                <label class="block text-sm font-semibold text-dark mb-2">
                                    URL Tujuan (Asli)
                                </label>

                                <input 
                                    type="url" 
                                    name="original_url" 
                                    required
                                    class="block w-full rounded-2xl border border-gray-light bg-white px-4 py-3 text-sm text-dark shadow-sm transition focus:border-brand-red focus:ring-2 focus:ring-brand-red-light focus:outline-none"
                                    placeholder="https://google.com/sangat-panjang-sekali"
                                >
                            </div>

                            <!-- SLUG -->
                            <div>
                                <label class="block text-sm font-semibold text-dark mb-2">
                                    Slug (Link Pendek)
                                </label>

                                <div class="flex rounded-2xl overflow-hidden border border-gray-light shadow-sm focus-within:ring-2 focus-within:ring-brand-red-light focus-within:border-brand-red">
                                    
                                    <span class="inline-flex items-center px-4 bg-gray-light text-gray-dark text-sm font-medium border-r border-gray-medium">
                                        {{ request()->getHost() }}/
                                    </span>

                                    <input 
                                        type="text" 
                                        name="slug" 
                                        required
                                        class="flex-1 border-0 px-4 py-3 text-sm text-dark focus:ring-0 focus:outline-none"
                                        placeholder="nama-link"
                                    >
                                </div>
                            </div>

                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="px-6 py-3 rounded-2xl bg-brand-red hover:bg-brand-red-light text-white shadow-md transition-all duration-200 hover:shadow-lg">
                                {{ __('Simpan Link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="bg-white border border-gray-light shadow-lg rounded-3xl overflow-hidden">

                <!-- HEADER -->
                <div class="flex items-center justify-between px-6 md:px-8 py-5 border-b border-gray-light bg-white">
                    <div>
                        <h3 class="text-lg font-bold text-dark">
                            Daftar Link Anda
                        </h3>
                        <p class="text-sm text-gray-dark mt-1">
                            Seluruh short link yang telah dibuat.
                        </p>
                    </div>

                    <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-light text-sm font-medium text-gray-dark">
                        Total :
                        <span class="text-brand-red font-bold">
                            {{ $links->count() }}
                        </span>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-light">

                        <thead class="bg-gray-light/40">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Slug
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    URL Asli
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Klik
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    QR
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-dark uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-light bg-white">
                            @foreach ($links as $link)
                            <tr class="hover:bg-gray-light/20 transition duration-150">

                                <!-- SLUG -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <a 
                                        href="{{ route('links.redirect', $link->slug) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 font-semibold text-brand-red hover:text-brand-red-dark transition"
                                    >
                                        <span>/{{ $link->slug }}</span>
                                    </a>
                                </td>

                                <!-- URL -->
                                <td class="px-6 py-5">
                                    <div class="max-w-sm truncate text-sm text-gray-dark">
                                        {{ $link->original_url }}
                                    </div>
                                </td>

                                <!-- KLIK -->
                                <td class="px-6 py-5 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center min-w-[44px] px-3 py-1 rounded-full bg-brand-red text-white text-xs font-bold shadow-sm">
                                        {{ $link->clicks }}
                                    </span>
                                </td>

                                <!-- QR -->
                                <td class="px-6 py-5 whitespace-nowrap text-center">
                                    <div class="flex flex-col items-center gap-2">

                                        <div class="bg-white border border-gray-light rounded-2xl p-2 shadow-sm">
                                            {!! QrCode::size(55)->generate(url($link->slug)) !!}
                                        </div>

                                        <a 
                                            href="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(500)->generate(url($link->slug))) }}"
                                            download="qr-{{ $link->slug }}.svg"
                                            class="text-[10px] font-bold uppercase tracking-wide text-brand-red hover:text-brand-red-dark transition"
                                        >
                                            Download SVG
                                        </a>
                                    </div>
                                </td>

                                <!-- ACTION -->
                                <td class="px-6 py-5 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- EDIT -->
                                        <a 
                                            href="#"
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-light text-gray-dark hover:bg-gray-light transition-all duration-200"
                                            title="Edit Link"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                class="w-4 h-4" 
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke="currentColor">
                                                <path stroke-linecap="round" 
                                                    stroke-linejoin="round" 
                                                    stroke-width="2" 
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.586-9.414a2 2 0 112.828 2.828L12 14l-4 1 1-4 8.414-8.414z" />
                                            </svg>
                                        </a>

                                        <!-- DELETE -->
                                        <form 
                                            action="{{ route('links.destroy', $link) }}" 
                                            method="POST"
                                            onsubmit="return confirm('Hapus link ini?')"
                                        >
                                            @csrf 
                                            @method('DELETE')

                                            <button 
                                                type="submit"
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-light text-brand-red hover:bg-brand-red hover:text-white transition-all duration-200"
                                                title="Hapus Link"
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

                <!-- EMPTY STATE -->
                @if($links->count() == 0)
                <div class="px-6 py-16 text-center">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-gray-light flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 5.656m1.414-7.07l1.414-1.415a4 4 0 115.656 5.657l-1.414 1.414m-7.071 1.414l-1.414 1.414a4 4 0 005.656 5.657l1.414-1.415"/>
                        </svg>
                    </div>

                    <h4 class="text-base font-bold text-dark">
                        Belum ada link
                    </h4>

                    <p class="mt-2 text-sm text-gray-dark">
                        Link yang Anda buat akan muncul di sini.
                    </p>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>