@extends('layouts.app')

@section('title', 'PT Ekonomi Aisyiyah Hasanah Makmur')

@section('content')
    @if ($promoBanner['enabled'] && filled($promoBanner['badgeTitle']) && filled($promoBanner['offerText']))
        <aside class="border-b border-amber-200 bg-amber-50">
            <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-4 sm:px-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-800">{{ $promoBanner['badgeTitle'] }}</span>
                    <p class="mt-2 font-semibold text-slate-900">{{ $promoBanner['offerText'] }}</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-sm">
                    @if (filled($promoBanner['voucherCode']))
                        <span class="rounded-lg border border-amber-300 bg-white px-3 py-2 font-bold text-amber-900">Kode voucher: {{ $promoBanner['voucherCode'] }}</span>
                    @endif
                    @if (filled($promoBanner['validUntil']))
                        <span class="text-slate-600">{{ $promoBanner['validUntil'] }}</span>
                    @endif
                </div>
            </div>
        </aside>
    @endif

    <section class="bg-gradient-to-br from-brand-950 via-brand-900 to-brand-800 text-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 sm:py-24 md:grid-cols-2 md:items-center">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-200">Pemberdayaan ekonomi umat &amp; UMKM</p>
                <h1 class="mt-4 font-serif text-4xl font-bold leading-tight sm:text-5xl">Produk pilihan, karya usaha lokal.</h1>
                <p class="mt-5 max-w-xl leading-relaxed text-emerald-50/85">Temukan produk skincare, makanan, dan kebersihan dari mitra usaha yang dikurasi oleh PT Ekonomi Aisyiyah Hasanah Makmur.</p>
                <a href="#produk" class="mt-8 inline-flex rounded-full bg-white px-6 py-3 font-semibold text-brand-900 hover:bg-emerald-50">Lihat kategori produk</a>
            </div>
            <div class="rounded-3xl border border-white/15 bg-white/10 p-8 shadow-xl backdrop-blur">
                <p class="text-sm font-semibold text-emerald-200">Tumbuh bersama</p>
                <h2 class="mt-3 font-serif text-3xl font-bold">Ekonomi yang berdaya dan berkemajuan</h2>
                <p class="mt-4 leading-relaxed text-emerald-50/80">Kami menghubungkan pelanggan dengan produk mitra dan UMKM, sekaligus mendukung pengelolaan persediaan dan penjualan yang lebih tertata.</p>
            </div>
        </div>
    </section>

    @if ($promoProducts->isNotEmpty())
        <section id="promo" class="bg-amber-50/80">
            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-widest text-amber-700">Promo pilihan</p>
                        <h2 class="mt-2 font-serif text-3xl font-bold text-slate-900">Harga spesial untuk Anda</h2>
                        <p class="mt-2 text-slate-600">Diskon aktif langsung diterapkan saat Anda memesan.</p>
                    </div>
                    <a href="#produk" class="rounded-full border border-amber-700 px-5 py-3 text-sm font-semibold text-amber-800 hover:bg-amber-100">Lihat semua produk</a>
                </div>
                <div class="mt-7 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($promoProducts as $promoProduct)
                        <article class="overflow-hidden rounded-2xl border border-amber-200 bg-white shadow-sm">
                            @if ($promoProduct->image_path)
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($promoProduct->image_path) }}" alt="{{ $promoProduct->name }}" class="h-44 w-full object-cover">
                            @else
                                <div class="flex h-44 items-center justify-center bg-gradient-to-br from-amber-100 to-orange-50 font-serif text-4xl font-bold text-amber-800">{{ \App\Models\Product::CATEGORIES[$promoProduct->category] ?? $promoProduct->category }}</div>
                            @endif
                            <div class="p-5">
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">Diskon {{ $promoProduct->activeDiscountPercent() }}%</span>
                                <h3 class="mt-3 font-semibold text-slate-900">{{ $promoProduct->name }}</h3>
                                <div class="mt-3 flex flex-wrap items-baseline gap-2">
                                    <p class="text-xl font-bold text-red-700">Rp {{ number_format($promoProduct->currentPrice(), 0, ',', '.') }}</p>
                                    <p class="text-sm text-slate-500 line-through">Rp {{ number_format($promoProduct->price, 0, ',', '.') }}</p>
                                </div>
                                @if ($promoProduct->discount_ends_at)
                                    <p class="mt-2 text-xs text-slate-500">Promo sampai {{ $promoProduct->discount_ends_at->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section id="sambutan" class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 md:grid-cols-2 md:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Sambutan</p>
            <h2 class="mt-2 font-serif text-3xl font-bold text-slate-900">Salam hangat dari Bapak Tafsir &amp; Ibu Dr. Eny Winaryati, M.Pd </h2>
            <div class="mt-7 grid grid-cols-2 gap-4">
                <div class="text-center">
                    @if ($tafsirPhoto)
                        <img src="{{ $tafsirPhoto }}" alt="Foto Bapak Tafsir" class="h-52 w-full rounded-2xl object-cover">
                    @else
                        <div class="flex h-52 items-center justify-center rounded-2xl bg-emerald-100 font-serif text-6xl font-bold text-brand-700" aria-label="Foto Bapak Tafsir belum diunggah">T</div>
                    @endif
                    <p class="mt-2 font-semibold">Bapak Tafsir</p>
                </div>
                <div class="text-center">
                    @if ($enyPhoto)
                        <img src="{{ $enyPhoto }}" alt="Foto Ibu Eny" class="h-52 w-full rounded-2xl object-cover">
                    @else
                        <div class="flex h-52 items-center justify-center rounded-2xl bg-emerald-100 font-serif text-6xl font-bold text-brand-700" aria-label="Foto Ibu Eny belum diunggah">E</div>
                    @endif
                    <p class="mt-2 font-semibold"> Dr. Eny Winaryati, M.Pd</p>
                </div>
            </div>
        </div>
        <div class="rounded-3xl border border-emerald-100 bg-white p-7 shadow-sm sm:p-10">
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Selamat datang</p>
            <blockquote class="mt-4 font-serif text-xl leading-relaxed text-slate-800">“{{ $welcomeMessage }}”</blockquote>
            <p class="mt-5 font-semibold text-slate-600">Bapak Tafsir &amp; Ibu Eny</p>
            @if (auth()->user()?->role === 'admin')
                <a href="{{ route('admin.dashboard') }}#sambutan" class="mt-5 inline-block text-sm font-semibold text-brand-700 underline">Kelola foto dan sambutan</a>
            @endif
        </div>
    </section>

    <section id="profil" class="bg-emerald-50/70">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6">
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Profil perusahaan</p>
            <h2 class="mt-2 font-serif text-3xl font-bold text-slate-900">Berkarya dan berdaya bersama</h2>
            <p class="mt-4 max-w-3xl leading-relaxed text-slate-600">PT Ekonomi Aisyiyah Hasanah Makmur menjadi wadah kolaborasi bagi mitra dan UMKM untuk memasarkan produk pilihan. Katalog dikelompokkan berdasarkan kategori dan persediaan dikelola oleh PIC Karesidenan.</p>
        </div>
    </section>

    <section id="produk" class="mx-auto max-w-7xl px-4 py-16 sm:px-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Katalog</p>
                <h2 class="mt-2 font-serif text-3xl font-bold text-slate-900">Produk berdasarkan kategori</h2>
                <p class="mt-2 text-slate-600">Pilih produk untuk dipesan. Stok tersedia berdasarkan Karesidenan tujuan.</p>
            </div>
            @auth
                @if (auth()->user()->role === 'customer')
                    <a href="{{ route('cart.index') }}" class="rounded-full bg-brand-700 px-5 py-3 text-sm font-semibold text-white hover:bg-brand-800">Keranjang ({{ array_sum(session('cart', [])) }})</a>
                @endif
            @else
                <a href="{{ route('register') }}" class="rounded-full border border-brand-700 px-5 py-3 text-sm font-semibold text-brand-800 hover:bg-brand-50">Daftar untuk berbelanja</a>
            @endauth
        </div>

        <div class="mt-9 space-y-12">
            @foreach ($categories as $category => $label)
                <section aria-label="{{ $label }}">
                    <div class="flex items-center gap-3">
                        <span class="h-8 w-1 rounded-full bg-brand-700"></span>
                        <h3 class="font-serif text-2xl font-bold text-slate-900">{{ $label }}</h3>
                    </div>
                    <div class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($productsByCategory->get($category, collect()) as $product)
                            <article class="overflow-hidden rounded-2xl border border-emerald-100 bg-white shadow-sm">
                                @if ($product->image_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image_path) }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">
                                @else
                                    <div class="flex h-48 items-center justify-center bg-gradient-to-br from-emerald-100 to-brand-50 font-serif text-4xl font-bold text-brand-800">{{ $label }}</div>
                                @endif
                                <div class="p-5">
                                    <h4 class="font-semibold text-slate-900">{{ $product->name }}</h4>
                                    <p class="mt-2 line-clamp-3 text-sm text-slate-600">{{ $product->description }}</p>
                                    @if ($product->isPromoActive())
                                        <div class="mt-4 flex flex-wrap items-baseline gap-2">
                                            <p class="text-lg font-bold text-red-700">Rp {{ number_format($product->currentPrice(), 0, ',', '.') }}</p>
                                            <p class="text-sm text-slate-500 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                            <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700">-{{ $product->activeDiscountPercent() }}%</span>
                                        </div>
                                    @else
                                        <p class="mt-4 text-lg font-bold text-brand-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    @endif
                                    <p class="mt-1 text-xs text-slate-500">Stok seluruh wilayah: {{ number_format($product->inventories_sum_quantity ?? 0, 0, ',', '.') }}</p>
                                    @auth
                                        @if (auth()->user()->role === 'customer')
                                            <form method="POST" action="{{ route('cart.items.store') }}" class="mt-4 flex gap-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <label class="sr-only" for="qty-{{ $product->id }}">Jumlah {{ $product->name }}</label>
                                                <input id="qty-{{ $product->id }}" type="number" name="quantity" value="1" min="1" max="99" class="w-20 rounded-lg border border-slate-300 px-3 py-2 text-sm">
                                                <button type="submit" class="flex-1 rounded-lg bg-brand-700 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-800">Tambah ke keranjang</button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="mt-4 inline-block text-sm font-semibold text-brand-700 underline">Masuk untuk memesan</a>
                                    @endauth
                                </div>
                            </article>
                        @empty
                            <p class="rounded-2xl border border-dashed border-emerald-200 bg-emerald-50/50 p-6 text-sm text-slate-500 sm:col-span-2 lg:col-span-3">Produk kategori {{ $label }} belum tersedia. Hubungi Admin untuk menambahkan produk.</p>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>
    </section>
@endsection
