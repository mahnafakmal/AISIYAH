<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — PT Ekonomi Aisyiyah Hasanah Makmur</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-sage-50 px-4 py-10">
    <main class="w-full max-w-md rounded-3xl border border-sage-200 bg-white p-7 shadow-lg sm:p-9">
        <a href="{{ route('home') }}" class="text-sm font-semibold text-brand-800 underline">Kembali ke beranda</a>
        <p class="mt-7 text-xs font-bold uppercase tracking-widest text-brand-700">Pelanggan baru</p>
        <h1 class="mt-2 font-serif text-3xl font-bold text-slate-950">Buat akun</h1>
        <p class="mt-2 text-sm text-slate-600">Akun ini digunakan untuk membuat pesanan dan mengirim bukti pembayaran.</p>
        @if ($errors->any())
            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-800">
                <ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register.store') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="name" class="mb-1 block text-sm font-semibold">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <div>
                <label for="email" class="mb-1 block text-sm font-semibold">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <div>
                <label for="phone" class="mb-1 block text-sm font-semibold">Nomor telepon (opsional)</label>
                <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <div>
                <label for="password" class="mb-1 block text-sm font-semibold">Kata sandi (minimal 8 karakter)</label>
                <input id="password" name="password" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-semibold">Ulangi kata sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <button type="submit" class="w-full rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900">Daftar sebagai pelanggan</button>
        </form>
        <p class="mt-5 text-center text-sm text-slate-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-brand-800 underline">Masuk</a></p>
    </main>
</body>
</html>
