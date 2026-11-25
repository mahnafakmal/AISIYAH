@extends('layouts.app')

@section('title', 'Dashboard PIC Karesidenan')

@section('content')
    <div class="mx-auto max-w-7xl space-y-9 px-4 py-10 sm:px-6">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Pengelolaan wilayah</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">PIC Karesidenan {{ $region }}</h1>
            <p class="mt-2 text-slate-600">Perbarui stok, pantau pesanan wilayah, dan unggah rekap penjualan.</p>
        </div>

        <section class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Transaksi terverifikasi</p><p class="mt-2 text-3xl font-bold">{{ $paidOrders->count() }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Total penjualan terverifikasi</p><p class="mt-2 text-3xl font-bold">Rp {{ number_format($salesTotal, 0, ',', '.') }}</p></div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="font-serif text-2xl font-bold">Perbarui stok produk</h2>
                <form method="POST" action="{{ route('pic.inventory.update') }}" class="mt-5 space-y-4">
                    @csrf @method('PUT')
                    <div><label for="inventory-product" class="mb-1 block text-sm font-semibold">Produk</label><select id="inventory-product" name="product_id" required class="w-full rounded-xl border border-slate-300 px-4 py-3">@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->name }} ({{ \App\Models\Product::CATEGORIES[$product->category] ?? $product->category }})</option>@endforeach</select></div>
                    <div><label for="inventory-quantity" class="mb-1 block text-sm font-semibold">Jumlah stok baru</label><input id="inventory-quantity" name="quantity" type="number" min="0" max="1000000" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                    <button class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800" type="submit">Simpan stok</button>
                </form>
            </div>
            <div class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="font-serif text-2xl font-bold">Impor stok dari CSV</h2>
                <p class="mt-2 text-sm text-slate-600">Unggah CSV dengan header <code class="rounded bg-slate-100 px-1">product_id,quantity</code>. Gunakan ID pada tabel stok di bawah; jumlah menggantikan stok Anda untuk wilayah {{ $region }}.</p>
                <form method="POST" action="{{ route('pic.inventory.upload') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                    @csrf
                    <div><label for="inventory-file" class="mb-1 block text-sm font-semibold">File stok (CSV)</label><input id="inventory-file" name="inventory_file" type="file" accept=".csv,.txt,text/csv" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5"></div>
                    <button class="rounded-xl border border-brand-700 px-5 py-3 font-semibold text-brand-800 hover:bg-brand-50" type="submit">Unggah dan perbarui stok</button>
                </form>
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Stok wilayah {{ $region }}</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[500px] text-left text-sm">
                    <thead class="border-b text-xs uppercase text-slate-500"><tr><th class="py-3 pr-4">ID</th><th class="py-3 pr-4">Produk</th><th class="py-3 pr-4">Kategori</th><th class="py-3">Stok</th></tr></thead>
                    <tbody class="divide-y">
                        @foreach ($products as $product)
                            <tr><td class="py-3 pr-4">{{ $product->id }}</td><td class="py-3 pr-4 font-medium">{{ $product->name }}</td><td class="py-3 pr-4">{{ \App\Models\Product::CATEGORIES[$product->category] ?? $product->category }}</td><td class="py-3">{{ $product->inventories->first()?->quantity ?? 0 }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="font-serif text-2xl font-bold">Unggah rekap penjualan</h2>
                <p class="mt-2 text-sm text-slate-600">Ringkasan otomatis hanya menghitung pesanan yang pembayarannya disetujui Admin.</p>
                <form method="POST" action="{{ route('pic.sales-reports.store') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                    @csrf
                    <div><label for="report-period" class="mb-1 block text-sm font-semibold">Periode</label><input id="report-period" name="period" type="month" value="{{ now()->format('Y-m') }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3"></div>
                    <div><label for="report-remarks" class="mb-1 block text-sm font-semibold">Catatan (opsional)</label><textarea id="report-remarks" name="remarks" rows="2" maxlength="1000" class="w-full rounded-xl border border-slate-300 px-4 py-3"></textarea></div>
                    <div><label for="report-file" class="mb-1 block text-sm font-semibold">File (PDF, CSV, Excel, atau gambar)</label><input id="report-file" name="report_file" type="file" accept=".pdf,.csv,.xls,.xlsx,.jpg,.jpeg,.png" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5"></div>
                    <button class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800" type="submit">Unggah rekap</button>
                </form>
                @if ($salesReports->isNotEmpty())
                    <div class="mt-6 border-t pt-4">
                        <h3 class="font-semibold">Rekap yang diunggah</h3>
                        <ul class="mt-2 space-y-2 text-sm">
                            @foreach ($salesReports as $report)
                                <li><a href="{{ route('pic.sales-reports.download', $report) }}" class="text-brand-700 underline">{{ $report->period }} — {{ $report->remarks ?: 'Unduh file rekap' }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
                <h2 class="font-serif text-2xl font-bold">Penjualan terverifikasi</h2>
                <div class="mt-4 space-y-3">
                    @forelse ($paidOrders as $order)
                        <article class="rounded-xl border border-slate-200 p-4">
                            <div class="flex flex-wrap justify-between gap-2"><p class="font-semibold">{{ $order->order_number }}</p><p class="font-semibold text-brand-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p></div>
                            <p class="mt-1 text-sm text-slate-600">{{ $order->user->name }} · {{ $order->created_at->format('d/m/Y') }}</p>
                            <p class="mt-2 text-xs text-slate-500">{{ $order->items->map(fn ($item) => $item->product_name.' × '.$item->quantity)->join(', ') }}</p>
                        </article>
                    @empty
                        <p class="rounded-xl bg-slate-50 p-4 text-sm text-slate-600">Belum ada pembayaran terverifikasi untuk wilayah ini.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection