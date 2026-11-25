<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard PIC {{ $region }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-sage-50 text-slate-800">
    <header class="bg-brand-950 text-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-5 sm:px-6">
            <div><a href="{{ route('home') }}" class="text-sm text-brand-200 underline">Lihat website</a><h1 class="mt-1 font-serif text-2xl font-bold">Dashboard PIC · {{ $region }}</h1><p class="text-sm text-brand-100">{{ auth()->user()->name }}</p></div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="rounded-xl border border-brand-600 px-4 py-2 text-sm font-semibold hover:bg-brand-900">Keluar</button></form>
        </div>
    </header>
    <main class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6">
        @if (session('status'))<p class="rounded-xl border border-brand-200 bg-brand-50 p-4 text-sm text-brand-900">{{ session('status') }}</p>@endif
        @if ($errors->any())<div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800"><ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

        <section class="grid gap-4 sm:grid-cols-2">
            <article class="rounded-2xl border border-sage-200 bg-white p-5"><p class="text-sm text-slate-500">Penjualan terverifikasi bulan ini</p><p class="mt-2 text-2xl font-bold text-brand-800">Rp {{ number_format($monthlySales, 0, ',', '.') }}</p></article>
            <article class="rounded-2xl border border-sage-200 bg-white p-5"><p class="text-sm text-slate-500">Pesanan lunas bulan ini</p><p class="mt-2 text-2xl font-bold text-slate-950">{{ $monthlyOrderCount }}</p></article>
        </section>

        <section class="rounded-2xl border border-sage-200 bg-white p-6">
            <h2 class="font-serif text-2xl font-bold text-slate-950">Persediaan wilayah</h2>
            <p class="mt-1 text-sm text-slate-600">Masukkan jumlah stok fisik terbaru untuk produk di Karesidenan {{ $region }}. Pesanan yang belum diverifikasi tetap diperhitungkan.</p>
            <div class="mt-5 space-y-3">
                @forelse ($products as $product)
                    @php($stock = $inventory->get($product->id)?->quantity ?? 0)
                    <form method="POST" action="{{ route('pic.inventory.update') }}" class="grid items-end gap-3 rounded-xl border border-sage-100 p-4 sm:grid-cols-[1fr_10rem_auto]">
                        @csrf @method('PUT')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div><p class="font-semibold text-slate-900">{{ $product->name }}</p><p class="text-xs text-slate-500">{{ $categories[$product->category] ?? $product->category }} · stok saat ini {{ $stock }}</p></div>
                        <div><label for="quantity-{{ $product->id }}" class="mb-1 block text-xs font-semibold">Stok terbaru</label><input id="quantity-{{ $product->id }}" name="quantity" type="number" min="0" max="1000000" value="{{ $stock }}" required class="w-full rounded-lg border border-sage-200 px-3 py-2"></div>
                        <button class="rounded-lg bg-brand-800 px-4 py-2 font-semibold text-white hover:bg-brand-900">Simpan stok</button>
                    </form>
                @empty
                    <p class="rounded-xl bg-sage-50 p-5 text-sm text-slate-600">Belum ada produk aktif. Hubungi Admin.</p>
                @endforelse
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-sage-200 bg-white p-6">
                <h2 class="font-serif text-2xl font-bold text-slate-950">Unggah rekap penjualan</h2>
                <p class="mt-1 text-sm text-slate-600">Unggah file rekap PDF, CSV, XLS, atau XLSX. Penjualan pesanan online terverifikasi juga direkap otomatis.</p>
                <form method="POST" action="{{ route('pic.reports.store') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                    @csrf
                    <div><label for="period" class="mb-1 block text-sm font-semibold">Periode rekap</label><input id="period" name="period" type="month" value="{{ now()->format('Y-m') }}" required class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></div>
                    <div><label for="report_file" class="mb-1 block text-sm font-semibold">File rekap (maks. 10 MB)</label><input id="report_file" name="report_file" type="file" accept=".pdf,.csv,.xls,.xlsx" required class="block w-full rounded-xl border border-sage-200 p-2 text-sm"></div>
                    <div><label for="remarks" class="mb-1 block text-sm font-semibold">Catatan (opsional)</label><textarea id="remarks" name="remarks" rows="2" maxlength="1000" class="w-full rounded-xl border border-sage-200 px-3 py-2.5"></textarea></div>
                    <button class="rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900">Unggah rekap</button>
                </form>
            </div>

            <div class="rounded-2xl border border-sage-200 bg-white p-6">
                <h2 class="font-serif text-2xl font-bold text-slate-950">Riwayat file rekap</h2>
                <ul class="mt-4 divide-y divide-sage-100">
                    @forelse ($reports as $report)
                        <li class="flex items-center justify-between gap-3 py-3">
                            <span><span class="block font-semibold">{{ $report->period }}</span><span class="text-xs text-slate-500">{{ $report->remarks ?? 'Tanpa catatan' }}</span></span>
                            <a href="{{ route('pic.reports.download', $report) }}" class="text-sm font-semibold text-brand-800 underline">Unduh</a>
                        </li>
                    @empty
                        <li class="py-4 text-sm text-slate-500">Belum ada file rekap diunggah.</li>
                    @endforelse
                </ul>
            </div>
        </section>

        <section class="rounded-2xl border border-sage-200 bg-white p-6">
            <h2 class="font-serif text-2xl font-bold text-slate-950">Penjualan bulan {{ now()->translatedFormat('F Y') }}</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">
                    <thead class="border-b border-sage-200 text-xs uppercase text-slate-500"><tr><th class="py-3 pr-3">Pesanan</th><th class="py-3 pr-3">Tanggal</th><th class="py-3 pr-3">Item</th><th class="py-3">Total</th></tr></thead>
                    <tbody class="divide-y divide-sage-100">
                        @forelse ($orders as $order)
                            <tr><td class="py-3 pr-3 font-semibold">{{ $order->order_number }}</td><td class="py-3 pr-3">{{ $order->created_at->format('d M Y') }}</td><td class="py-3 pr-3">{{ $order->items->sum('quantity') }}</td><td class="py-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td></tr>
                        @empty
                            <tr><td colspan="4" class="py-5 text-slate-500">Belum ada penjualan terverifikasi bulan ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
