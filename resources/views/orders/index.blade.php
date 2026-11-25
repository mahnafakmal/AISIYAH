@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <section class="mx-auto max-w-5xl space-y-5 px-4 py-10 sm:px-6">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Akun pelanggan</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">Pesanan saya</h1>
        </div>
        @forelse ($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="block rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:border-emerald-300">
                <div class="flex flex-wrap justify-between gap-3">
                    <div><p class="font-semibold">{{ $order->order_number }}</p><p class="mt-1 text-sm text-slate-600">{{ $order->region }} · {{ $order->created_at->format('d/m/Y H:i') }}</p></div>
                    <div class="text-right"><p class="font-bold text-brand-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p><p class="mt-1 text-sm">{{ str_replace('_', ' ', ucfirst($order->status)) }}</p></div>
                </div>
            </a>
        @empty
            <div class="rounded-2xl bg-white p-6 text-slate-600">Anda belum memiliki pesanan. <a href="{{ route('storefront') }}#produk" class="font-semibold text-brand-700 underline">Lihat katalog</a>.</div>
        @endforelse
    </section>
@endsection