<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT Ekonomi Aisyiyah Hasanah Makmur')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    <header class="border-b border-emerald-100 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="{{ route('storefront') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-700 font-serif text-lg font-bold text-white">EA</span>
                <span>
                    <span class="block font-serif text-sm font-bold text-slate-900 sm:text-base">PT Ekonomi Aisyiyah Hasanah Makmur</span>
                    <span class="block text-xs font-semibold tracking-wide text-brand-700">Ekonomi umat &amp; UMKM</span>
                </span>
            </a>
            <nav class="flex flex-wrap items-center gap-3 text-sm font-medium sm:gap-5">
                <a href="{{ route('storefront') }}#profil" class="hover:text-brand-700">Profil</a>
                <a href="{{ route('storefront') }}#sambutan" class="hover:text-brand-700">Sambutan</a>
                <a href="{{ route('storefront') }}#produk" class="hover:text-brand-700">Produk</a>
                <a href="{{ route('storefront') }}#pic" class="hover:text-brand-700">PIC Karesidenan</a>
                @auth
                    @if (auth()->user()->role === 'customer')
                        <a href="{{ route('cart.index') }}" class="rounded-full border border-emerald-200 px-3 py-2 hover:bg-brand-50">Keranjang</a>
                        <a href="{{ route('orders.index') }}" class="hover:text-brand-700">Pesanan</a>
                    @elseif (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-700">Dashboard Admin</a>
                    @elseif (auth()->user()->role === 'pic')
                        <a href="{{ route('pic.dashboard') }}" class="hover:text-brand-700">Dashboard PIC</a>
                    @else
                        <a href="{{ route('pimpinan.dashboard') }}" class="hover:text-brand-700">Dashboard Pimpinan</a>
                    @endif
                    <span class="hidden text-slate-500 md:inline">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-full bg-slate-100 px-3 py-2 hover:bg-slate-200" type="submit">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brand-700">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-brand-700 px-4 py-2 text-white hover:bg-brand-800">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    @if (session('status'))
        <div class="mx-auto mt-5 max-w-7xl px-4 sm:px-6">
            <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">{{ session('status') }}</div>
        </div>
    @endif
    @if ($errors->any())
        <div class="mx-auto mt-5 max-w-7xl px-4 sm:px-6">
            <div role="alert" class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <p class="font-semibold">Mohon periksa kembali:</p>
                <ul class="mt-1 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-emerald-900 bg-brand-950 text-emerald-50">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-2">
            <div>
                <p class="font-serif text-lg font-bold">PT Ekonomi Aisyiyah Hasanah Makmur</p>
                <p class="mt-2 text-sm text-emerald-100/75">Membangun kemandirian ekonomi umat bersama UMKM.</p>
                @if (($marketplaceLinks ?? collect())->isNotEmpty())
                    <div class="mt-5">
                        <h2 class="text-sm font-semibold">Belanja di Marketplace</h2>
                        <div class="mt-2 flex flex-wrap gap-3 text-sm">
                            @foreach ($marketplaceLinks as $marketplaceLink)
                                <a href="{{ $marketplaceLink['url'] }}" target="_blank" rel="noopener noreferrer" class="text-emerald-100 underline decoration-emerald-100/50 underline-offset-4 hover:text-white">{{ $marketplaceLink['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <p class="mt-5 text-xs text-emerald-100/60">&copy; {{ now()->year }} PT Ekonomi Aisyiyah Hasanah Makmur. Seluruh hak cipta dilindungi.</p>
            </div>
            <div id="pic">
                <h2 class="font-semibold">PIC Karesidenan</h2>
                <div class="mt-3 grid gap-2 text-sm text-emerald-100/80 sm:grid-cols-2">
                    @forelse ($picUsers ?? [] as $pic)
                        <div>
                            <span class="font-semibold text-white">{{ $pic->region }}</span>
                            <span class="block">{{ $pic->name }}@if ($pic->phone) · {{ $pic->phone }}@endif</span>
                        </div>
                    @empty
                        <p class="text-emerald-100/60">Informasi PIC akan tampil setelah Admin menambahkan akun PIC.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
