<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan {{ $order->order_number }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-sage-50 text-slate-800">
    <main class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <a href="{{ route('orders.index') }}" class="text-sm font-semibold text-brand-800 underline">Pesanan saya</a>
        <section class="mt-5 rounded-3xl border border-sage-200 bg-white p-6 shadow-sm sm:p-9">
            <p class="text-xs font-bold uppercase tracking-widest text-brand-700">Detail pesanan</p>
            <h1 class="mt-2 font-serif text-3xl font-bold text-slate-950">{{ $order->order_number }}</h1>
            <p class="mt-2 text-sm text-slate-600">Karesidenan {{ $order->region }} · Status: <span class="font-semibold">{{ str_replace('_', ' ', ucfirst($order->status)) }}</span></p>
            @if ($order->expires_at)
                <p class="mt-1 text-xs text-slate-500">Batas pembayaran: {{ $order->expires_at->format('d M Y H:i') }}</p>
            @endif

            <div class="mt-6 divide-y divide-sage-100 border-y border-sage-100">
                @foreach ($order->items as $item)
                    <div class="flex justify-between gap-4 py-3 text-sm">
                        <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                        <span class="font-semibold">Rp {{ number_format($item->line_total, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <p class="mt-4 text-right text-lg font-bold text-brand-800">Total Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>

            @if (session('status'))
                <p class="mt-5 rounded-xl border border-brand-200 bg-brand-50 p-3 text-sm text-brand-900">{{ session('status') }}</p>
            @endif
            @if ($errors->any())
                <p class="mt-5 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-800">{{ $errors->first() }}</p>
            @endif

            @if (in_array($order->status, [\App\Models\Order::PENDING_PAYMENT, \App\Models\Order::PAYMENT_REJECTED], true))
                <div class="mt-6 rounded-2xl bg-sage-50 p-5">
                    <h2 class="font-semibold text-slate-900">Unggah bukti pembayaran</h2>
                    <p class="mt-1 text-sm text-slate-600">Format gambar JPG, PNG, atau WebP. Maksimal 10 MB. Stok baru dikurangi setelah Admin menyetujui pembayaran.</p>
                    <form method="POST" action="{{ route('orders.proof.store', $order) }}" enctype="multipart/form-data" class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-end">
                        @csrf
                        <div class="flex-1">
                            <label for="proof" class="mb-1 block text-sm font-medium">File bukti pembayaran</label>
                            <input id="proof" name="proof" type="file" accept="image/*" required class="block w-full rounded-xl border border-sage-200 bg-white p-2 text-sm">
                        </div>
                        <button class="rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900">Kirim bukti</button>
                    </form>
                </div>
            @endif

            @if ($order->paymentProofs->isNotEmpty())
                <div class="mt-6">
                    <h2 class="font-semibold text-slate-900">Riwayat bukti pembayaran</h2>
                    <ul class="mt-2 space-y-2">
                        @foreach ($order->paymentProofs as $proof)
                            <li class="flex items-center justify-between gap-3 rounded-xl border border-sage-200 p-3 text-sm">
                                <span>{{ $proof->created_at->format('d M Y H:i') }} · {{ ucfirst($proof->status) }}</span>
                                <a href="{{ route('payment-proofs.show', $proof) }}" target="_blank" class="font-semibold text-brand-800 underline">Lihat berkas</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>
    </main>
</body>
</html>
