@extends('layouts.app')

@section('title', 'Pesanan '.$order->order_number)

@section('content')
    <section class="mx-auto max-w-4xl space-y-6 px-4 py-10 sm:px-6">
        <div>
            <a href="{{ route('orders.index') }}" class="text-sm font-semibold text-brand-700 underline">← Kembali ke pesanan</a>
            <h1 class="mt-3 font-serif text-3xl font-bold">Pesanan {{ $order->order_number }}</h1>
            <p class="mt-2 text-slate-600">Karesidenan {{ $order->region }} · Status: {{ str_replace('_', ' ', ucfirst($order->status)) }}</p>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <h2 class="font-semibold">Rincian produk</h2>
            <div class="mt-3 divide-y">
                @foreach ($order->items as $item)
                    <div class="flex justify-between gap-4 py-3 text-sm">
                        <span>
                            {{ $item->product_name }} × {{ $item->quantity }}
                            @if ($item->discount_percent !== null && $item->original_unit_price !== null)
                                <span class="block text-slate-500">
                                    <span class="line-through">Rp {{ number_format($item->original_unit_price, 0, ',', '.') }}</span>
                                    · promo {{ $item->discount_percent }}% · Rp {{ number_format($item->unit_price, 0, ',', '.') }} / item
                                </span>
                            @else
                                <span class="text-slate-500">(Rp {{ number_format($item->unit_price, 0, ',', '.') }} / item)</span>
                            @endif
                        </span>
                        <span class="font-semibold">Rp {{ number_format($item->line_total, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <p class="mt-4 border-t pt-4 text-right text-lg font-bold">Total Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <h2 class="font-semibold">Bukti pembayaran</h2>
            <div class="mt-3 space-y-3">
                @forelse ($order->paymentProofs as $proof)
                    <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl bg-slate-50 p-3 text-sm">
                        <div><p class="font-medium">Diunggah {{ $proof->created_at->format('d/m/Y H:i') }} · {{ ucfirst($proof->status) }}</p>@if ($proof->review_note)<p class="mt-1 text-red-700">{{ $proof->review_note }}</p>@endif</div>
                        <a href="{{ route('orders.payment-proofs.download', $proof) }}" class="font-semibold text-brand-700 underline">Unduh</a>
                    </div>
                @empty
                    <p class="text-sm text-slate-600">Belum ada bukti pembayaran yang diunggah.</p>
                @endforelse
            </div>
            @if ($order->status === \App\Models\Order::PENDING_PAYMENT)
                <form method="POST" action="{{ route('orders.payment-proofs.store', $order) }}" enctype="multipart/form-data" class="mt-5 space-y-4 border-t pt-5">
                    @csrf
                    <div><label for="payment-proof" class="mb-1 block text-sm font-semibold">Unggah bukti (JPG, PNG, WebP, atau PDF; maks. 5 MB)</label><input id="payment-proof" name="proof" type="file" accept=".jpg,.jpeg,.png,.webp,.pdf" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5"></div>
                    <button type="submit" class="rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800">Kirim bukti pembayaran</button>
                </form>
            @elseif ($order->status === \App\Models\Order::PAID)
                <p class="mt-5 rounded-xl bg-emerald-50 p-4 text-sm font-semibold text-emerald-800">Pembayaran telah diverifikasi.</p>
            @endif
        </div>
    </section>
@endsection