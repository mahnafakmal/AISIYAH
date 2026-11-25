<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard {{ ucfirst($user->role) }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-sage-50 text-slate-800">
    <header class="bg-brand-950 text-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-5 sm:px-6">
            <div>
                <a href="{{ route('home') }}" class="text-sm text-brand-200 underline">Lihat website</a>
                <h1 class="mt-1 font-serif text-2xl font-bold">Dashboard {{ ucfirst($user->role) }}</h1>
                <p class="text-sm text-brand-100">{{ $user->name }} · {{ $user->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="rounded-xl border border-brand-600 px-4 py-2 text-sm font-semibold hover:bg-brand-900">Keluar</button></form>
        </div>
    </header>

    <main class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6">
        @if (session('status'))
            <p class="rounded-xl border border-brand-200 bg-brand-50 p-4 text-sm text-brand-900">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                <ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-2xl border border-sage-200 bg-white p-5"><p class="text-sm text-slate-500">Penjualan terverifikasi</p><p class="mt-2 text-2xl font-bold text-brand-800">Rp {{ number_format($summary['sales'], 0, ',', '.') }}</p></article>
            <article class="rounded-2xl border border-sage-200 bg-white p-5"><p class="text-sm text-slate-500">Menunggu verifikasi</p><p class="mt-2 text-2xl font-bold text-slate-950">{{ $summary['pending'] }}</p></article>
            <article class="rounded-2xl border border-sage-200 bg-white p-5"><p class="text-sm text-slate-500">Produk aktif</p><p class="mt-2 text-2xl font-bold text-slate-950">{{ $summary['products'] }}</p></article>
            <article class="rounded-2xl border border-sage-200 bg-white p-5"><p class="text-sm text-slate-500">PIC Karesidenan</p><p class="mt-2 text-2xl font-bold text-slate-950">{{ $summary['pic'] }}</p></article>
        </section>

        @if ($user->role === 'admin')
            <section class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl border border-sage-200 bg-white p-6">
                    <h2 class="font-serif text-2xl font-bold text-slate-950">Tambah produk</h2>
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="mt-5 grid gap-4 sm:grid-cols-2">
                        @csrf
                        <div class="sm:col-span-2"><label for="name" class="mb-1 block text-sm font-semibold">Nama</label><input id="name" name="name" value="{{ old('name') }}" required maxlength="255" class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div><label for="category" class="mb-1 block text-sm font-semibold">Kategori</label><select id="category" name="category" required class="w-full rounded-xl border border-sage-200 bg-white px-3 py-2.5">@foreach ($categories as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach</select></div>
                        <div><label for="price" class="mb-1 block text-sm font-semibold">Harga (Rp)</label><input id="price" name="price" type="number" min="1" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div class="sm:col-span-2"><label for="description" class="mb-1 block text-sm font-semibold">Deskripsi</label><textarea id="description" name="description" rows="3" required maxlength="3000" class="w-full rounded-xl border border-sage-200 px-3 py-2.5">{{ old('description') }}</textarea></div>
                        <div class="sm:col-span-2"><label for="image" class="mb-1 block text-sm font-semibold">Foto produk (opsional)</label><input id="image" name="image" type="file" accept="image/*" class="block w-full rounded-xl border border-sage-200 p-2 text-sm"></div>
                        <button class="rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900 sm:col-span-2">Simpan produk</button>
                    </form>
                </div>

                <div class="rounded-2xl border border-sage-200 bg-white p-6">
                    <h2 class="font-serif text-2xl font-bold text-slate-950">Tambah pengguna staf</h2>
                    <form method="POST" action="{{ route('admin.users.store') }}" class="mt-5 grid gap-4 sm:grid-cols-2">
                        @csrf
                        <div><label for="staff-name" class="mb-1 block text-sm font-semibold">Nama</label><input id="staff-name" name="name" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div><label for="staff-email" class="mb-1 block text-sm font-semibold">Email</label><input id="staff-email" name="email" type="email" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div><label for="staff-role" class="mb-1 block text-sm font-semibold">Peran</label><select id="staff-role" name="role" required class="w-full rounded-xl border border-sage-200 bg-white px-3 py-2.5"><option value="pic">PIC Karesidenan</option><option value="pimpinan">Pimpinan</option><option value="admin">Admin</option></select></div>
                        <div><label for="staff-region" class="mb-1 block text-sm font-semibold">Karesidenan (wajib untuk PIC)</label><input id="staff-region" name="region" maxlength="120" class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div><label for="staff-phone" class="mb-1 block text-sm font-semibold">Nomor telepon</label><input id="staff-phone" name="phone" type="tel" class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div><label for="staff-password" class="mb-1 block text-sm font-semibold">Kata sandi (min. 12 karakter)</label><input id="staff-password" name="password" type="password" minlength="12" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <div class="sm:col-span-2"><label for="staff-password-confirmation" class="mb-1 block text-sm font-semibold">Ulangi kata sandi</label><input id="staff-password-confirmation" name="password_confirmation" type="password" minlength="12" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                        <button class="rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900 sm:col-span-2">Buat akun</button>
                    </form>
                </div>
            </section>

            <section class="rounded-2xl border border-sage-200 bg-white p-6">
                <h2 class="font-serif text-2xl font-bold text-slate-950">Sambutan halaman utama</h2>
                <p class="mt-1 text-sm text-slate-600">Unggah foto resmi dan sesuaikan teks sambutan yang tampil di beranda.</p>
                <form method="POST" action="{{ route('admin.welcome.update') }}" enctype="multipart/form-data" class="mt-5 grid gap-4 md:grid-cols-2">
                    @csrf
                    <div class="md:col-span-2"><label for="welcome_message" class="mb-1 block text-sm font-semibold">Pesan sambutan</label><textarea id="welcome_message" name="welcome_message" rows="4" required maxlength="3000" class="w-full rounded-xl border border-sage-200 px-3 py-2.5">{{ data_get($settings, 'welcome_message', 'Selamat datang di PT Ekonomi Aisyiyah Hasanah Makmur. Mari berkolaborasi memberdayakan produk lokal, memperkuat UMKM, dan menumbuhkan kemandirian ekonomi umat agar semakin banyak manfaat dirasakan masyarakat.') }}</textarea></div>
                    <div><label for="tafsir_name" class="mb-1 block text-sm font-semibold">Nama Bapak Tafsir</label><input id="tafsir_name" name="tafsir_name" value="{{ data_get($settings, 'tafsir_name', 'Bapak Tafsir') }}" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                    <div><label for="eny_name" class="mb-1 block text-sm font-semibold">Nama Ibu Eny</label><input id="eny_name" name="eny_name" value="{{ data_get($settings, 'eny_name', 'Ibu Eny') }}" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                    <div><label for="tafsir_photo" class="mb-1 block text-sm font-semibold">Foto Bapak Tafsir</label><input id="tafsir_photo" name="tafsir_photo" type="file" accept="image/*" class="block w-full rounded-xl border border-sage-200 p-2 text-sm"></div>
                    <div><label for="eny_photo" class="mb-1 block text-sm font-semibold">Foto Ibu Eny</label><input id="eny_photo" name="eny_photo" type="file" accept="image/*" class="block w-full rounded-xl border border-sage-200 p-2 text-sm"></div>
                    <button class="rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900 md:col-span-2">Simpan sambutan</button>
                </form>
            </section>

            <section class="rounded-2xl border border-sage-200 bg-white p-6">
                <h2 class="font-serif text-2xl font-bold text-slate-950">Produk aktif</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full min-w-[600px] text-left text-sm">
                        <thead class="border-b border-sage-200 text-xs uppercase text-slate-500"><tr><th class="py-3 pr-3">Produk</th><th class="py-3 pr-3">Kategori</th><th class="py-3 pr-3">Harga</th><th class="py-3">Aksi</th></tr></thead>
                        <tbody class="divide-y divide-sage-100">
                            @forelse ($products as $product)
                                <tr><td class="py-3 pr-3 font-semibold">{{ $product->name }}</td><td class="py-3 pr-3">{{ $categories[$product->category] ?? $product->category }}</td><td class="py-3 pr-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td><td class="py-3"><form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Sembunyikan produk ini?')">@csrf @method('DELETE')<button class="font-semibold text-red-700 underline">Sembunyikan</button></form></td></tr>
                            @empty
                                <tr><td colspan="4" class="py-5 text-slate-500">Belum ada produk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-2xl border border-sage-200 bg-white p-6">
                <h2 class="font-serif text-2xl font-bold text-slate-950">Pengguna staf</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full min-w-[600px] text-left text-sm">
                        <thead class="border-b border-sage-200 text-xs uppercase text-slate-500"><tr><th class="py-3 pr-3">Nama</th><th class="py-3 pr-3">Peran</th><th class="py-3 pr-3">Karesidenan</th><th class="py-3">Kontak</th></tr></thead>
                        <tbody class="divide-y divide-sage-100">
                            @forelse ($staff as $member)
                                <tr><td class="py-3 pr-3 font-semibold">{{ $member->name }}</td><td class="py-3 pr-3">{{ ucfirst($member->role) }}</td><td class="py-3 pr-3">{{ $member->region ?? '—' }}</td><td class="py-3">{{ $member->phone ?? $member->email }}</td></tr>
                            @empty
                                <tr><td colspan="4" class="py-5 text-slate-500">Belum ada pengguna staf.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        <section class="rounded-2xl border border-sage-200 bg-white p-6">
            <h2 class="font-serif text-2xl font-bold text-slate-950">Verifikasi bukti pembayaran</h2>
            @if ($user->role === 'pimpinan')
                <p class="mt-1 text-sm text-slate-600">Akses Pimpinan bersifat baca-saja. Persetujuan pembayaran dilakukan oleh Admin.</p>
            @endif
            <div class="mt-5 space-y-4">
                @forelse ($pendingOrders as $order)
                    @php($proof = $order->paymentProofs->first())
                    <article class="rounded-2xl border border-sage-200 p-5">
                        <div class="flex flex-wrap justify-between gap-3">
                            <div><h3 class="font-bold text-slate-950">{{ $order->order_number }}</h3><p class="text-sm text-slate-600">{{ $order->user->name }} · {{ $order->region }}</p></div>
                            <p class="font-bold text-brand-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <ul class="mt-3 list-inside list-disc text-sm text-slate-600">@foreach ($order->items as $item)<li>{{ $item->product_name }} × {{ $item->quantity }}</li>@endforeach</ul>
                        @if ($proof)
                            <a href="{{ route('payment-proofs.show', $proof) }}" target="_blank" class="mt-3 inline-block font-semibold text-brand-800 underline">Buka bukti pembayaran</a>
                        @endif
                        @if ($user->role === 'admin')
                            <div class="mt-4 flex flex-wrap gap-3">
                                <form method="POST" action="{{ route('admin.orders.approve', $order) }}">@csrf<button class="rounded-xl bg-brand-800 px-4 py-2.5 text-sm font-semibold text-white">Setujui &amp; kurangi stok</button></form>
                                <form method="POST" action="{{ route('admin.orders.reject', $order) }}" class="flex flex-1 flex-wrap gap-2">@csrf<input name="review_note" required maxlength="1000" placeholder="Alasan penolakan" class="min-w-48 flex-1 rounded-xl border border-sage-200 px-3 py-2 text-sm"><button class="rounded-xl border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-700">Tolak</button></form>
                            </div>
                        @endif
                    </article>
                @empty
                    <p class="rounded-xl bg-sage-50 p-5 text-sm text-slate-600">Tidak ada bukti pembayaran yang menunggu verifikasi.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-2xl border border-sage-200 bg-white p-6">
            <h2 class="font-serif text-2xl font-bold text-slate-950">Rekap penjualan PIC</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">
                    <thead class="border-b border-sage-200 text-xs uppercase text-slate-500"><tr><th class="py-3 pr-3">Periode</th><th class="py-3 pr-3">Karesidenan</th><th class="py-3 pr-3">PIC</th><th class="py-3">File</th></tr></thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($reports as $report)
                            <tr><td class="py-3 pr-3">{{ $report->period }}</td><td class="py-3 pr-3">{{ $report->region }}</td><td class="py-3 pr-3">{{ $report->user->name }}</td><td class="py-3"><a href="{{ route('admin.reports.download', $report) }}" class="font-semibold text-brand-800 underline">Unduh</a></td></tr>
                        @empty
                            <tr><td colspan="4" class="py-5 text-slate-500">Belum ada rekap yang diunggah PIC.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
