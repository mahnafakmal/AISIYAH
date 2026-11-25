@extends('layouts.app')

@section('title', 'Keranjang belanja')

@section('content')
    <section class="mx-auto max-w-5xl space-y-6 px-4 py-10 sm:px-6">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Belanja</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">Keranjang belanja</h1>
        </div>
        @forelse ($items as $item)
            <article class="flex flex-col justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center">
                <div>
                    <h2 class="font-semibold">{{ $item['product']->name }}</h2>
                    @if ($item['discount_percent'] !== null)
                        <p class="mt-1 text-sm text-slate-500">Harga normal <span class="line-through">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</span> · diskon {{ $item['discount_percent'] }}%</p>
                        <p class="text-sm font-semibold text-red-700">Harga promo Rp {{ number_format($item['unit_price'], 0, ',', '.') }} per item</p>
                    @else
                        <p class="mt-1 text-sm text-slate-600">Rp {{ number_format($item['unit_price'], 0, ',', '.') }} per item</p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <form method="POST" action="{{ route('cart.items.update', $item['product']) }}" class="flex items-center gap-2">
                        @csrf @method('PUT')
                        <label class="sr-only" for="cart-qty-{{ $item['product']->id }}">Jumlah {{ $item['product']->name }}</label>
                        <input id="cart-qty-{{ $item['product']->id }}" name="quantity" type="number" value="{{ $item['quantity'] }}" min="1" max="99" required class="w-20 rounded-lg border border-slate-300 px-3 py-2">
                        <button class="rounded-lg border border-slate-300 px-3 py-2 text-sm" type="submit">Ubah</button>
                    </form>
                    <div class="text-right">
                        <span class="font-semibold">Rp {{ number_format($item['line_total'], 0, ',', '.') }}</span>
                        @if ($item['discount_percent'] !== null)
                            <span class="block text-xs text-slate-500 line-through">Rp {{ number_format($item['original_line_total'], 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('cart.items.destroy', $item['product']) }}">@csrf @method('DELETE')<button class="text-sm text-red-700 underline" type="submit">Hapus</button></form>
                </div>
            </article>
        @empty
            <div class="rounded-2xl bg-white p-6 text-slate-600">Keranjang masih kosong. <a href="{{ route('storefront') }}#produk" class="font-semibold text-brand-700 underline">Pilih produk</a>.</div>
        @endforelse

        @if ($items->isNotEmpty())
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <p class="text-right text-xl font-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                <form method="POST" action="{{ route('orders.store') }}" class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-end">
                    @csrf
                    <div class="w-full sm:max-w-sm">
                        <label for="region" class="mb-1 block text-sm font-semibold">Karesidenan tujuan</label>
                        <select id="region" name="region" required class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option value="">Pilih karesidenan</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}">{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" @disabled($regions->isEmpty()) class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800 disabled:cursor-not-allowed disabled:opacity-50">Buat pesanan</button>
                </form>
                @if ($regions->isEmpty())
                    <p class="mt-3 text-right text-sm text-amber-700">Pemesanan belum tersedia karena Admin belum menambahkan PIC Karesidenan.</p>
                @endif
                <p class="mt-3 text-right text-xs text-slate-500">Stok akan dikurangi saat pesanan dibuat untuk mencegah pemesanan melebihi persediaan wilayah.</p>
            </div>
        @endif
    </section>
@endsection
