@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <section class="mx-auto max-w-lg px-4 py-16 sm:px-6">
        <div class="rounded-3xl border border-emerald-100 bg-white p-7 shadow-sm sm:p-10">
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Akun</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">Masuk</h1>
            <p class="mt-2 text-sm text-slate-600">Gunakan akun pelanggan, Admin, Pimpinan, atau PIC Karesidenan.</p>
            <form method="POST" action="{{ route('login.store') }}" class="mt-7 space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-1 block text-sm font-semibold">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label for="password" class="mb-1 block text-sm font-semibold">Kata sandi</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
                    Ingat saya
                </label>
                <button type="submit" class="w-full rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800">Masuk</button>
            </form>
            <p class="mt-5 text-sm text-slate-600">Belum punya akun pelanggan? <a href="{{ route('register') }}" class="font-semibold text-brand-700 underline">Daftar</a></p>
        </div>
    </section>
@endsection