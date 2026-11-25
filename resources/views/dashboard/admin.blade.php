@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mx-auto max-w-7xl space-y-10 px-4 py-10 sm:px-6">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Panel pengelolaan</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">Dashboard Admin</h1>
            <p class="mt-2 text-slate-600">Kelola katalog, promo, akun, sambutan, dan verifikasi pembayaran.</p>
            <a href="#promo" class="mt-4 inline-flex rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-900 hover:bg-amber-200">Atur promo produk</a>
        </div>

        <section class="grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Produk aktif</p><p class="mt-2 text-3xl font-bold">{{ $products->where('is_active', true)->count() }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Pesanan</p><p class="mt-2 text-3xl font-bold">{{ $orders->count() }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Bukti menunggu verifikasi</p><p class="mt-2 text-3xl font-bold">{{ $pendingProofs->count() }}</p></div>
        </section>

        <section id="produk" class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Tambah produk</h2>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="mt-5 grid gap-4 sm:grid-cols-2">
                @csrf
                <div><label for="product-name" class="mb-1 block text-sm font-semibold">Nama produk</label><input id="product-name" name="name" value="{{ old('name') }}" required maxlength="255" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="product-category" class="mb-1 block text-sm font-semibold">Kategori</label><select id="product-category" name="category" required class="w-full rounded-xl border border-slate-300 px-4 py-3">@foreach (\App\Models\Product::CATEGORIES as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach</select></div>
                <div><label for="product-price" class="mb-1 block text-sm font-semibold">Harga (Rp)</label><input id="product-price" name="price" type="number" min="1" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="product-image" class="mb-1 block text-sm font-semibold">Foto produk (opsional)</label><input id="product-image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-slate-300 px-4 py-2.5"></div>
                <div class="sm:col-span-2"><label for="product-description" class="mb-1 block text-sm font-semibold">Deskripsi</label><textarea id="product-description" name="description" rows="3" required maxlength="5000" class="w-full rounded-xl border border-slate-300 px-4 py-3">{{ old('description') }}</textarea></div>
                <div class="sm:col-span-2"><button class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800" type="submit">Simpan produk</button></div>
            </form>

            <h3 class="mt-9 font-semibold">Katalog saat ini</h3>
            <div class="mt-3 overflow-x-auto">
                <table class="w-full min-w-[700px] text-left text-sm">
                    <thead class="border-b text-xs uppercase text-slate-500"><tr><th class="py-3 pr-4">Produk</th><th class="py-3 pr-4">Kategori</th><th class="py-3 pr-4">Harga</th><th class="py-3 pr-4">Stok</th><th class="py-3 pr-4">Status</th><th class="py-3">Aksi</th></tr></thead>
                    <tbody class="divide-y">
                        @forelse ($products as $product)
                            <tr>
                                <td class="py-3 pr-4 font-medium">{{ $product->name }}</td>
                                <td class="py-3 pr-4">{{ \App\Models\Product::CATEGORIES[$product->category] ?? $product->category }}</td>
                                <td class="py-3 pr-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="py-3 pr-4">{{ $product->inventories_sum_quantity ?? 0 }}</td>
                                <td class="py-3 pr-4">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                                <td class="py-3">
                                    @if ($product->is_active)
                                        <form method="POST" action="{{ route('admin.products.archive', $product) }}" onsubmit="return confirm('Nonaktifkan produk ini?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-700 underline" type="submit">Nonaktifkan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-5 text-center text-slate-500">Belum ada produk. Tambahkan produk di atas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section id="promo" class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Promo &amp; Diskon</h2>
            <div class="mt-5 grid gap-4 lg:grid-cols-2">
                <section class="rounded-2xl border border-emerald-200 p-5">
                    <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-3">
                        <div>
                            <h3 class="font-semibold">Banner Pengumuman Promo Toko</h3>
                            <p class="mt-1 text-xs text-slate-500">Atur teks penawaran dan kode voucher di bagian atas website.</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.promo-settings.update') }}" class="mt-4 space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="promo_banner_enabled" value="0">
                        <label class="flex items-center gap-2 text-sm font-semibold">
                            <input type="checkbox" name="promo_banner_enabled" value="1" @checked(old('promo_banner_enabled', $siteSettings->get('promo_banner_enabled', '0')) === '1') class="rounded border-slate-300 text-emerald-700">
                            Aktifkan banner
                        </label>
                        <div>
                            <label for="promo-badge-title" class="mb-1 block text-sm font-semibold">Judul badge promo</label>
                            <input id="promo-badge-title" name="promo_badge_title" value="{{ old('promo_badge_title', $siteSettings->get('promo_badge_title')) }}" maxlength="100" required class="w-full rounded-xl border border-slate-300 px-4 py-3" placeholder="PROMO GEBYAR EKONOMI UMAT">
                        </div>
                        <div>
                            <label for="promo-offer-text" class="mb-1 block text-sm font-semibold">Teks penawaran promo</label>
                            <textarea id="promo-offer-text" name="promo_offer_text" maxlength="500" required rows="2" class="w-full rounded-xl border border-slate-300 px-4 py-3" placeholder="Diskon spesial untuk produk pilihan!">{{ old('promo_offer_text', $siteSettings->get('promo_offer_text')) }}</textarea>
                        </div>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <label for="promo-voucher-code" class="mb-1 block text-sm font-semibold">Kode voucher (opsional)</label>
                                <input id="promo-voucher-code" name="promo_voucher_code" value="{{ old('promo_voucher_code', $siteSettings->get('promo_voucher_code')) }}" maxlength="50" class="w-full rounded-xl border border-slate-300 px-4 py-3" placeholder="AISYIYAH20">
                            </div>
                            <div>
                                <label for="promo-valid-until" class="mb-1 block text-sm font-semibold">Masa berlaku (opsional)</label>
                                <input id="promo-valid-until" name="promo_valid_until" value="{{ old('promo_valid_until', $siteSettings->get('promo_valid_until')) }}" maxlength="100" class="w-full rounded-xl border border-slate-300 px-4 py-3" placeholder="Berlaku s/d 31 Des 2026">
                            </div>
                        </div>
                        <button type="submit" class="rounded-xl bg-brand-700 px-5 py-3 text-sm font-semibold text-white hover:bg-brand-800">Simpan pengaturan promo</button>
                    </form>
                </section>

                <section class="rounded-2xl border border-emerald-200 bg-emerald-50/40 p-5">
                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-800">Promo cepat katalog</span>
                    <h3 class="mt-3 font-semibold">Diskon Persentase Massal</h3>
                    <p class="mt-1 text-xs leading-relaxed text-slate-500">Terapkan potongan harga otomatis ke semua produk aktif atau hanya produk pada kategori tertentu.</p>
                    <form method="POST" action="{{ route('admin.promotions.apply') }}" class="mt-4 space-y-3">
                        @csrf
                        <div>
                            <label for="promo-target-category" class="mb-1 block text-sm font-semibold">Target kategori</label>
                            <select id="promo-target-category" name="target_category" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3">
                                <option value="all" @selected(old('target_category', 'all') === 'all')>Semua barang ({{ $activeProductsCount }} produk)</option>
                                @foreach (\App\Models\Product::CATEGORIES as $key => $label)
                                    <option value="{{ $key }}" @selected(old('target_category') === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="mass-discount-percent" class="mb-1 block text-sm font-semibold">Persentase diskon (%)</label>
                            <div class="flex flex-col gap-2 sm:flex-row">
                                <input id="mass-discount-percent" name="discount_percent" type="number" min="1" max="90" value="{{ old('discount_percent', 15) }}" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 sm:w-24">
                                <button type="submit" @disabled($activeProductsCount === 0) class="flex-1 rounded-xl bg-brand-700 px-4 py-3 text-sm font-semibold text-white hover:bg-brand-800 disabled:cursor-not-allowed disabled:opacity-50">Terapkan diskon</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('admin.promotions.reset') }}" class="mt-4 border-t border-emerald-100 pt-4" onsubmit="return confirm('Hapus semua promo dan kembalikan harga ke harga normal?')">
                        @csrf
                        @method('DELETE')
                        <p class="mb-2 text-xs text-slate-500">{{ $promoProductsCount }} produk sedang memiliki pengaturan promo.</p>
                        <button type="submit" @disabled($promoProductsCount === 0) class="w-full rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-700 hover:bg-red-50 disabled:cursor-not-allowed disabled:opacity-50">Reset Semua Harga Promo Produk</button>
                    </form>
                </section>

                <section class="rounded-2xl border border-slate-200 bg-slate-50 p-5 lg:col-span-2">
                    <div>
                        <h3 class="font-semibold">Tautan Toko Marketplace Utama (Default Global)</h3>
                        <p class="mt-1 text-xs text-slate-500">Tautan ini ditampilkan di website sebagai pintasan belanja marketplace.</p>
                    </div>
                    <form method="POST" action="{{ route('admin.marketplace-settings.update') }}" class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="shopee-url" class="mb-1 block text-sm font-semibold">URL Toko Shopee</label>
                            <input id="shopee-url" name="shopee_url" type="url" value="{{ old('shopee_url', $siteSettings->get('marketplace_shopee_url')) }}" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5" placeholder="https://shopee.co.id/toko">
                        </div>
                        <div>
                            <label for="tokopedia-url" class="mb-1 block text-sm font-semibold">URL Toko Tokopedia</label>
                            <input id="tokopedia-url" name="tokopedia_url" type="url" value="{{ old('tokopedia_url', $siteSettings->get('marketplace_tokopedia_url')) }}" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5" placeholder="https://www.tokopedia.com/toko">
                        </div>
                        <div>
                            <label for="tiktok-url" class="mb-1 block text-sm font-semibold">URL TikTok Shop</label>
                            <input id="tiktok-url" name="tiktok_url" type="url" value="{{ old('tiktok_url', $siteSettings->get('marketplace_tiktok_url')) }}" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5" placeholder="https://www.tiktok.com/@toko">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full rounded-xl bg-brand-700 px-5 py-3 text-sm font-semibold text-white hover:bg-brand-800">Simpan tautan</button>
                        </div>
                    </form>
                </section>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Buat akun staf</h2>
            <p class="mt-2 text-sm text-slate-600">Akun publik hanya dapat menjadi pelanggan. Admin membuat akun staf dengan peran di bawah.</p>
            <form method="POST" action="{{ route('admin.staff.store') }}" class="mt-5 grid gap-4 sm:grid-cols-2">
                @csrf
                <div><label for="staff-name" class="mb-1 block text-sm font-semibold">Nama</label><input id="staff-name" name="name" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="staff-email" class="mb-1 block text-sm font-semibold">Email</label><input id="staff-email" name="email" type="email" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="staff-role" class="mb-1 block text-sm font-semibold">Peran</label><select id="staff-role" name="role" required class="w-full rounded-xl border border-slate-300 px-4 py-3"><option value="pic">PIC Karesidenan</option><option value="pimpinan">Pimpinan</option><option value="admin">Admin</option></select></div>
                <div><label for="staff-region" class="mb-1 block text-sm font-semibold">Karesidenan (wajib untuk PIC)</label><input id="staff-region" name="region" maxlength="255" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="staff-phone" class="mb-1 block text-sm font-semibold">Nomor telepon</label><input id="staff-phone" name="phone" type="tel" class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="staff-password" class="mb-1 block text-sm font-semibold">Kata sandi (min. 8 karakter)</label><input id="staff-password" name="password" type="password" minlength="8" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div><label for="staff-password-confirmation" class="mb-1 block text-sm font-semibold">Ulangi kata sandi</label><input id="staff-password-confirmation" name="password_confirmation" type="password" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                <div class="flex items-end"><button class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800" type="submit">Buat akun staf</button></div>
            </form>
            <div class="mt-6 grid gap-2 sm:grid-cols-2">
                @foreach ($staffUsers as $staff)
                    <div class="rounded-xl bg-slate-50 p-3 text-sm"><span class="font-semibold">{{ $staff->name }}</span> · {{ ucfirst($staff->role) }}@if ($staff->region) · {{ $staff->region }}@endif<span class="block text-slate-500">{{ $staff->email }}@if ($staff->phone) · {{ $staff->phone }}@endif</span></div>
                @endforeach
            </div>
        </section>

        <section id="sambutan" class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Foto dan sambutan</h2>
            <p class="mt-2 text-sm text-slate-600">Unggah foto asli Bapak Tafsir dan Ibu Eny serta perbarui teks sambutan untuk halaman pertama.</p>
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                @csrf @method('PUT')
                <div><label for="welcome-message" class="mb-1 block text-sm font-semibold">Teks sambutan</label><textarea id="welcome-message" name="welcome_message" rows="4" required maxlength="3000" class="w-full rounded-xl border border-slate-300 px-4 py-3">{{ $siteSettings->get('welcome_message') ?? 'Selamat datang di PT Ekonomi Aisyiyah Hasanah Makmur. Mari berkolaborasi memberdayakan produk lokal, memperkuat UMKM, dan menumbuhkan kemandirian ekonomi umat.' }}</textarea></div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div><label for="tafsir-photo" class="mb-1 block text-sm font-semibold">Foto Bapak Tafsir</label><input id="tafsir-photo" name="tafsir_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-slate-300 px-4 py-2.5">@if ($siteSettings->get('tafsir_photo'))<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($siteSettings->get('tafsir_photo')) }}" alt="Foto Bapak Tafsir" class="mt-3 h-28 rounded-xl object-cover">@endif</div>
                    <div><label for="eny-photo" class="mb-1 block text-sm font-semibold">Foto Ibu Eny</label><input id="eny-photo" name="eny_photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-slate-300 px-4 py-2.5">@if ($siteSettings->get('eny_photo'))<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($siteSettings->get('eny_photo')) }}" alt="Foto Ibu Eny" class="mt-3 h-28 rounded-xl object-cover">@endif</div>
                </div>
                <button class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800" type="submit">Simpan sambutan</button>
            </form>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Verifikasi bukti pembayaran</h2>
            <div class="mt-5 space-y-4">
                @forelse ($pendingProofs as $proof)
                    <div class="flex flex-col justify-between gap-4 rounded-2xl border border-slate-200 p-4 md:flex-row md:items-center">
                        <div>
                            <p class="font-semibold">{{ $proof->order->order_number }} · {{ $proof->order->user->name }}</p>
                            <p class="text-sm text-slate-600">Rp {{ number_format($proof->order->total_amount, 0, ',', '.') }} · {{ $proof->order->region }} · diunggah {{ $proof->created_at->format('d/m/Y H:i') }}</p>
                            <a class="mt-1 inline-block text-sm font-semibold text-brand-700 underline" href="{{ route('admin.payment-proofs.download', $proof) }}">Lihat bukti pembayaran</a>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('admin.payment-proofs.approve', $proof) }}">@csrf<button class="rounded-lg bg-brand-700 px-4 py-2 text-sm font-semibold text-white" type="submit">Setujui</button></form>
                            <form method="POST" action="{{ route('admin.payment-proofs.reject', $proof) }}" class="flex gap-2">@csrf<input name="review_note" required maxlength="1000" placeholder="Alasan penolakan" class="min-w-40 rounded-lg border border-slate-300 px-3 py-2 text-sm"><button class="rounded-lg bg-red-700 px-4 py-2 text-sm font-semibold text-white" type="submit">Tolak</button></form>
                        </div>
                    </div>
                @empty
                    <p class="rounded-xl bg-emerald-50 p-4 text-sm text-slate-600">Tidak ada bukti yang menunggu verifikasi.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Pesanan dan rekap wilayah</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[650px] text-left text-sm">
                    <thead class="border-b text-xs uppercase text-slate-500"><tr><th class="py-3 pr-4">Nomor</th><th class="py-3 pr-4">Pelanggan</th><th class="py-3 pr-4">Wilayah</th><th class="py-3 pr-4">Total</th><th class="py-3 pr-4">Status</th><th class="py-3 pr-4">Dibuat</th><th class="py-3">Aksi</th></tr></thead>
                    <tbody class="divide-y">
                        @forelse ($orders as $order)
                            <tr>
                                <td class="py-3 pr-4">{{ $order->order_number }}</td>
                                <td class="py-3 pr-4">{{ $order->user->name }}</td>
                                <td class="py-3 pr-4">{{ $order->region }}</td>
                                <td class="py-3 pr-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="py-3 pr-4">{{ str_replace('_', ' ', ucfirst($order->status)) }}</td>
                                <td class="py-3">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="py-3">
                                    @if ($order->status === \App\Models\Order::PENDING_PAYMENT)
                                        <form method="POST" action="{{ route('admin.orders.cancel', $order) }}" onsubmit="return confirm('Batalkan pesanan dan kembalikan stok?')">
                                            @csrf
                                            <button class="text-red-700 underline" type="submit">Batalkan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="py-5 text-center text-slate-500">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($salesReports->isNotEmpty())
                <h3 class="mt-7 font-semibold">File rekap dari PIC</h3>
                <ul class="mt-2 space-y-2 text-sm">
                    @foreach ($salesReports as $report)
                        <li><a class="text-brand-700 underline" href="{{ route('admin.sales-reports.download', $report) }}">{{ $report->region }} · {{ $report->period }} · {{ $report->user->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
@endsection