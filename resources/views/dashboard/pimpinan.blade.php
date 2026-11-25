@extends('layouts.app')

@section('title', 'Dashboard Pimpinan')

@section('content')
    <div class="mx-auto max-w-7xl space-y-8 px-4 py-10 sm:px-6">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Ringkasan perusahaan</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">Dashboard Pimpinan</h1>
        </div>
        <section class="grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Produk aktif</p><p class="mt-2 text-3xl font-bold">{{ $products->count() }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Pembayaran terverifikasi</p><p class="mt-2 text-3xl font-bold">{{ $paidOrders }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Total penjualan terverifikasi</p><p class="mt-2 text-3xl font-bold">Rp {{ number_format($salesTotal, 0, ',', '.') }}</p></div>
        </section>
        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Persediaan per produk</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[500px] text-left text-sm">
                    <thead class="border-b text-xs uppercase text-slate-500"><tr><th class="py-3 pr-4">Produk</th><th class="py-3 pr-4">Kategori</th><th class="py-3">Stok seluruh wilayah</th></tr></thead>
                    <tbody class="divide-y">
                        @forelse ($products as $product)
                            <tr><td class="py-3 pr-4">{{ $product->name }}</td><td class="py-3 pr-4">{{ \App\Models\Product::CATEGORIES[$product->category] ?? $product->category }}</td><td class="py-3">{{ $product->inventories_sum_quantity ?? 0 }}</td></tr>
                        @empty
                            <tr><td colspan="3" class="py-5 text-slate-500">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">PIC Karesidenan</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($picUsers as $pic)
                    <div class="rounded-xl bg-emerald-50 p-4"><p class="font-semibold">{{ $pic->region }}</p><p class="mt-1 text-sm">{{ $pic->name }}</p><p class="text-sm text-slate-600">{{ $pic->phone ?: $pic->email }}</p></div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada akun PIC.</p>
                @endforelse
            </div>
        </section>
        <section class="rounded-3xl bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-serif text-2xl font-bold">Pesanan terbaru</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[650px] text-left text-sm">
                    <thead class="border-b text-xs uppercase text-slate-500"><tr><th class="py-3 pr-4">Nomor</th><th class="py-3 pr-4">Pelanggan</th><th class="py-3 pr-4">Karesidenan</th><th class="py-3 pr-4">Total</th><th class="py-3">Status</th></tr></thead>
                    <tbody class="divide-y">
                        @forelse ($orders as $order)
                            <tr><td class="py-3 pr-4">{{ $order->order_number }}</td><td class="py-3 pr-4">{{ $order->user->name }}</td><td class="py-3 pr-4">{{ $order->region }}</td><td class="py-3 pr-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td><td class="py-3">{{ str_replace('_', ' ', ucfirst($order->status)) }}</td></tr>
                        @empty
                            <tr><td colspan="5" class="py-5 text-slate-500">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
