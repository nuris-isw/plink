<x-guest-layout>

    <!-- TITLE -->
    <div class="text-center">
        <h1 class="text-2xl font-bold text-dark tracking-tight">
            Perpenas Link Manager
        </h1>

        <p class="mt-3 text-sm leading-relaxed text-gray-dark">
            Halaman awal untuk mengakses sistem
            <span class="font-semibold text-brand-red">
                Link Shortener
            </span>
            dan pengelolaan QR Code.
        </p>
    </div>

    <!-- SESSION STATUS -->
    <div class="mt-6">
        <x-auth-session-status class="mb-4" :status="session('status')" />
    </div>

    <!-- GOOGLE LOGIN -->
    <div class="mt-8">

        <a
            href="{{ route('google.login') }}"
            class="group inline-flex w-full items-center justify-center gap-3 rounded-2xl border border-gray-light bg-white px-5 py-4 text-sm font-semibold text-dark shadow-sm transition-all duration-200 hover:border-brand-red hover:bg-gray-light/20 hover:shadow-md"
        >

            <!-- GOOGLE ICON -->
            <img
                src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                class="w-5 h-5"
                alt="Google"
            >

            <span>
                Login with Google
            </span>
        </a>

        <p class="mt-4 text-center text-xs leading-relaxed text-gray-dark">
            Gunakan akun Google yang telah didaftarkan administrator
            untuk masuk ke sistem.
        </p>

    </div>

    <!-- FOOTER -->
    <div class="mt-8 text-center text-xs text-gray-dark">
        © {{ date('Y') }} Perpenas Link Manager
    </div>

</x-guest-layout>