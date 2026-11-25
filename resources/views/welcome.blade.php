<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Ekonomi Aisyiyah Hasanah Makmur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-slate-800 antialiased">
    <header class="sticky top-0 z-30 border-b border-sage-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex size-11 items-center justify-center rounded-xl bg-brand-800 font-serif text-lg font-bold text-white">EA</span>
                <span>
                    <span class="block font-serif text-sm font-bold text-slate-900 sm:text-base">PT Ekonomi Aisyiyah Hasanah Makmur</span>
                    <span class="block text-xs font-semibold uppercase tracking-wider text-brand-700">Ekonomi umat &amp; UMKM</span>
                </span>
            </a>
            <nav class="hidden items-center gap-5 text-sm font-medium md:flex">
                <a href="#profil" class="hover:text-brand-700">Profil</a>
                <a href="#sambutan" class="hover:text-brand-700">Sambutan</a>
                <a href="#produk" class="hover:text-brand-700">Produk</a>
                <a href="#pic" class="hover:text-brand-700">PIC Karesidenan</a>
            </nav>
            <div class="flex items-center gap-2">
                @auth
                    @if (auth()->user()->isStaff())
                        <a href="{{ route('dashboard') }}" class="rounded-full bg-brand-800 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-900">Dashboard</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="rounded-full bg-brand-800 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-900">Pesanan Saya</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-full border border-sage-200 px-4 py-2 text-sm font-semibold hover:bg-sage-50">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-full border border-sage-200 px-4 py-2 text-sm font-semibold hover:bg-sage-50">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-brand-800 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-900">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    @if (session('status'))
        <div class="mx-auto mt-5 max-w-7xl rounded-xl border border-brand-200 bg-brand-50 px-4 py-3 text-sm text-brand-900">{{ session('status') }}</div>
    @endif

    <main>
        <section class="bg-gradient-to-br from-brand-50 via-white to-sage-50">
            <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 md:grid-cols-2 md:py-24">
                <div class="space-y-6">
                    <span class="inline-flex rounded-full border border-brand-200 bg-white px-4 py-2 text-xs font-bold uppercase tracking-wider text-brand-800">Pemberdayaan ekonomi umat &amp; UMKM</span>
                    <h1 class="font-serif text-4xl font-bold leading-tight text-slate-950 sm:text-5xl">Produk pilihan, karya usaha lokal.</h1>
                    <p class="max-w-xl text-lg leading-relaxed text-slate-600">Temukan produk skincare, makanan, dan kebersihan dari mitra usaha yang dikurasi oleh PT Ekonomi Aisyiyah Hasanah Makmur.</p>
                    <a href="#produk" class="inline-flex rounded-full bg-brand-800 px-6 py-3 font-semibold text-white shadow hover:bg-brand-900">Lihat kategori produk</a>
                </div>
                <div class="relative overflow-hidden rounded-3xl bg-brand-900 p-8 text-white shadow-xl sm:p-12">
                    <div class="absolute -right-10 -top-10 size-48 rounded-full bg-brand-600/30"></div>
                    <div class="relative space-y-4">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-gold-400">Tumbuh bersama</p>
                        <h2 class="font-serif text-3xl font-bold">Ekonomi yang berdaya dan berkemajuan</h2>
                        <p class="leading-relaxed text-brand-100">Kami menghubungkan pelanggan dengan produk mitra dan UMKM, sekaligus mendukung pengelolaan persediaan dan penjualan yang lebih tertata.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="sambutan" class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <div class="mx-auto mb-10 max-w-3xl text-center">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand-700">Sambutan</p>
                <h2 class="mt-2 font-serif text-3xl font-bold text-slate-950 sm:text-4xl">Salam hangat dari Bapak Tafsir &amp; Ibu Eny</h2>
                <p class="mt-3 text-slate-600">Sambutan untuk mitra, pelanggan, dan seluruh penggerak ekonomi umat.</p>
            </div>
            <div class="grid gap-6 lg:grid-cols-[1fr_1.4fr]">
                <div class="grid grid-cols-2 gap-4">
                    @foreach ([
                        ['name' => data_get($settings, 'tafsir_name', 'Bapak Tafsir'), 'key' => 'tafsir_photo', 'initial' => 'T'],
                        ['name' => data_get($settings, 'eny_name', 'Ibu Eny'), 'key' => 'eny_photo', 'initial' => 'E'],
                    ] as $person)
                        <div class="overflow-hidden rounded-2xl border border-sage-200 bg-sage-50 text-center">
                            @if (data_get($settings, $person['key']))
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url(data_get($settings, $person['key'])) }}" alt="{{ $person['name'] }}" class="aspect-[4/5] w-full object-cover">
                            @else
                                <div class="flex aspect-[4/5] items-center justify-center bg-gradient-to-br from-brand-200 to-sage-100 font-serif text-7xl font-bold text-brand-800" aria-label="Foto {{ $person['name'] }}">{{ $person['initial'] }}</div>
                            @endif
                            <p class="px-3 py-3 font-semibold text-slate-900">{{ $person['name'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="flex flex-col justify-center rounded-2xl border border-sage-200 bg-white p-7 shadow-sm sm:p-10">
                    <p class="text-xs font-bold uppercase tracking-widest text-brand-700">Selamat datang</p>
                    <blockquote class="mt-4 font-serif text-xl leading-relaxed text-slate-800 sm:text-2xl">
                        {{ data_get($settings, 'welcome_message', 'Selamat datang di PT Ekonomi Aisyiyah Hasanah Makmur. Mari berkolaborasi memberdayakan produk lokal, memperkuat UMKM, dan menumbuhkan kemandirian ekonomi umat agar semakin banyak manfaat dirasakan masyarakat.') }}
                    </blockquote>
                    <p class="mt-6 text-sm font-semibold text-slate-500">Bapak Tafsir &amp; Ibu Eny</p>
                </div>
            </div>
        </section>

        <section id="profil" class="border-y border-sage-200 bg-sage-50">
            <div class="mx-auto grid max-w-7xl gap-8 px-4 py-14 sm:px-6 md:grid-cols-3">
                <div class="md:col-span-1">
                    <p class="text-xs font-bold uppercase tracking-widest text-brand-700">Profil perusahaan</p>
                    <h2 class="mt-2 font-serif text-3xl font-bold text-slate-950">Berkarya dan berdaya bersama</h2>
                </div>
                <p class="leading-relaxed text-slate-600 md:col-span-2">PT Ekonomi Aisyiyah Hasanah Makmur menjadi wadah kolaborasi bagi mitra dan UMKM untuk memasarkan produk pilihan. Katalog dikelompokkan berdasarkan kategori dan persediaan dikelola oleh PIC Karesidenan.</p>
            </div>
        </section>

        <section id="produk" class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
            <div class="mb-10 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-brand-700">Katalog</p>
                    <h2 class="mt-2 font-serif text-3xl font-bold text-slate-950 sm:text-4xl">Produk berdasarkan kategori</h2>
                    <p class="mt-2 max-w-2xl text-slate-600">Pilih produk untuk dipesan. Stok dikonfirmasi kembali berdasarkan Karesidenan tujuan.</p>
                </div>
                <a href="#keranjang" class="font-semibold text-brand-800 underline underline-offset-4">Keranjang (<span id="cart-count">0</span>)</a>
            </div>

            @foreach ($categories as $category => $label)
                <section class="mb-12" aria-labelledby="category-{{ $category }}">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-px flex-1 bg-sage-200"></span>
                        <h3 id="category-{{ $category }}" class="font-serif text-2xl font-bold text-brand-900">{{ $label }}</h3>
                        <span class="h-px flex-1 bg-sage-200"></span>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($products->get($category, collect()) as $product)
                            @php($stock = $product->inventory->sum('quantity'))
                            <article class="flex flex-col overflow-hidden rounded-2xl border border-sage-200 bg-white shadow-sm">
                                @if ($product->image_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" alt="{{ $product->name }}" class="aspect-[4/3] w-full bg-sage-50 object-cover" loading="lazy">
                                @else
                                    <div class="flex aspect-[4/3] items-center justify-center bg-gradient-to-br from-brand-100 to-sage-100 font-serif text-2xl font-bold text-brand-800">{{ $label }}</div>
                                @endif
                                <div class="flex flex-1 flex-col p-5">
                                    <h4 class="text-lg font-bold text-slate-950">{{ $product->name }}</h4>
                                    <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $product->description }}</p>
                                    <div class="mt-4 flex items-center justify-between gap-3">
                                        <span class="text-lg font-bold text-brand-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="text-xs {{ $stock > 0 ? 'text-emerald-700' : 'text-slate-500' }}">{{ $stock > 0 ? 'Stok tersedia' : 'Stok kosong' }}</span>
                                    </div>
                                    @if ($stock > 0)
                                        <button type="button" data-add-to-cart data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" class="mt-4 rounded-xl bg-brand-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-900">Tambah ke keranjang</button>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <p class="rounded-2xl border border-dashed border-sage-200 bg-sage-50 p-6 text-sm text-slate-600 sm:col-span-2 lg:col-span-3">Produk kategori {{ strtolower($label) }} belum tersedia. Hubungi Admin untuk menambahkan produk.</p>
                        @endforelse
                    </div>
                </section>
            @endforeach

            <div id="keranjang" class="rounded-2xl border border-brand-200 bg-brand-50 p-6 sm:p-8">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-brand-700">Keranjang belanja</p>
                        <h3 class="mt-1 font-serif text-2xl font-bold text-brand-950">Pesanan Anda</h3>
                    </div>
                    <p class="text-sm font-semibold text-brand-800">Total: <span id="cart-total">Rp 0</span></p>
                </div>
                <p id="cart-message" class="mt-2 text-sm text-brand-800" aria-live="polite"></p>
                <ul id="cart-items" class="mt-3 divide-y divide-sage-100"></ul>
                @auth
                    @if (auth()->user()->role === 'customer')
                        <form id="order-form" method="POST" action="{{ route('orders.store') }}" class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-end">
                            @csrf
                            <div class="flex-1">
                                <label for="region" class="mb-1 block text-sm font-semibold">Karesidenan tujuan</label>
                                <select id="region" name="region" required class="w-full rounded-xl border border-sage-200 bg-white px-3 py-2.5">
                                    <option value="">Pilih Karesidenan</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region }}">{{ $region }}</option>
                                    @endforeach
                                </select>
                                @if ($regions->isEmpty())
                                    <p class="mt-1 text-xs text-red-700">Pemesanan belum tersedia sampai Admin menambahkan PIC Karesidenan.</p>
                                @endif
                            </div>
                            <button id="checkout-button" type="submit" class="rounded-xl bg-brand-800 px-6 py-3 font-semibold text-white hover:bg-brand-900 disabled:cursor-not-allowed">Buat pesanan</button>
                        </form>
                    @else
                        <p class="mt-4 text-sm text-slate-700">Silakan masuk dengan akun pelanggan untuk membuat pesanan.</p>
                    @endif
                @else
                    <p class="mt-4 text-sm text-slate-700">Masuk atau daftar sebagai pelanggan untuk melanjutkan pesanan.</p>
                    <div class="mt-3 flex gap-3">
                        <a href="{{ route('login') }}" class="rounded-xl bg-brand-800 px-5 py-2.5 text-sm font-semibold text-white">Masuk</a>
                        <a href="{{ route('register') }}" class="rounded-xl border border-brand-300 px-5 py-2.5 text-sm font-semibold text-brand-900">Buat akun</a>
                    </div>
                @endauth
                @if ($errors->any())
                    <ul class="mt-3 list-inside list-disc text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </section>

        <section id="pic" class="bg-brand-950 text-white">
            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
                <div class="mb-8">
                    <p class="text-xs font-bold uppercase tracking-widest text-gold-400">Jaringan wilayah</p>
                    <h2 class="mt-2 font-serif text-3xl font-bold">PIC Karesidenan</h2>
                    <p class="mt-2 text-brand-100">Hubungi PIC untuk informasi persediaan di wilayah Anda.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($pics as $pic)
                        <div class="rounded-2xl border border-brand-700 bg-brand-900/70 p-5">
                            <p class="font-semibold text-white">{{ $pic->name }}</p>
                            <p class="mt-1 text-sm text-brand-100">{{ $pic->region }}</p>
                            @if ($pic->phone)
                                <a href="tel:{{ $pic->phone }}" class="mt-3 inline-block text-sm font-semibold text-gold-400 underline">{{ $pic->phone }}</a>
                            @endif
                        </div>
                    @empty
                        <p class="rounded-2xl border border-brand-700 bg-brand-900/70 p-5 text-sm text-brand-100 sm:col-span-2 lg:col-span-3">Informasi PIC Karesidenan akan tampil setelah Admin menambahkan akun PIC.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-brand-950 px-4 py-6 text-center text-xs text-brand-200 sm:px-6">
        <p>&copy; {{ now()->year }} PT Ekonomi Aisyiyah Hasanah Makmur. Seluruh hak cipta dilindungi.</p>
        <p class="mt-1 text-brand-300">Membangun kemandirian ekonomi umat bersama UMKM.</p>
    </footer>
</body>
</html>
