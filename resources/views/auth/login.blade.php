<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — PT Ekonomi Aisyiyah Hasanah Makmur</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex min-h-screen items-center justify-center bg-sage-50 px-4 py-10">
    <main class="w-full max-w-md rounded-3xl border border-sage-200 bg-white p-7 shadow-lg sm:p-9">
        <a href="{{ route('home') }}" class="text-sm font-semibold text-brand-800 underline">Kembali ke beranda</a>
        <p class="mt-7 text-xs font-bold uppercase tracking-widest text-brand-700">Akun pengguna</p>
        <h1 class="mt-2 font-serif text-3xl font-bold text-slate-950">Masuk</h1>
        <p class="mt-2 text-sm text-slate-600">Gunakan akun pelanggan, Admin, Pimpinan, atau PIC Karesidenan.</p>
        @if ($errors->any())
            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-800">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="mb-1 block text-sm font-semibold">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <div>
                <label for="password" class="mb-1 block text-sm font-semibold">Kata sandi</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full rounded-xl border border-sage-200 px-4 py-3 focus:border-brand-600 focus:outline-none">
            </div>
            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" value="1" class="rounded border-sage-300 text-brand-700">
                Ingat saya
            </label>
            <button type="submit" class="w-full rounded-xl bg-brand-800 px-5 py-3 font-semibold text-white hover:bg-brand-900">Masuk</button>
        </form>
        <p class="mt-5 text-center text-sm text-slate-600">Belum punya akun pelanggan? <a href="{{ route('register') }}" class="font-semibold text-brand-800 underline">Daftar</a></p>
    </main>
</body>
</html>
