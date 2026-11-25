<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-sage-50 text-slate-800">
    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
        <a href="{{ route('home') }}" class="text-sm font-semibold text-brand-800 underline">Kembali ke katalog</a>
        <h1 class="mt-5 font-serif text-3xl font-bold text-slate-950">Pesanan Saya</h1>
        <div class="mt-6 space-y-4">
            @forelse ($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="block rounded-2xl border border-sage-200 bg-white p-5 shadow-sm hover:border-brand-300">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <span class="font-bold text-slate-950">{{ $order->order_number }}</span>
                        <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-800">{{ str_replace('_', ' ', ucfirst($order->status)) }}</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">{{ $order->region }} · {{ $order->items->sum('quantity') }} item</p>
                    <p class="mt-1 font-semibold text-brand-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </a>
            @empty
                <p class="rounded-2xl border border-sage-200 bg-white p-6 text-slate-600">Belum ada pesanan.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $orders->links() }}</div>
    </main>
</body>
</html>
