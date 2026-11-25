@extends('layouts.app')

@section('title', 'Daftar pelanggan')

@section('content')
    <section class="mx-auto max-w-lg px-4 py-16 sm:px-6">
        <div class="rounded-3xl border border-emerald-100 bg-white p-7 shadow-sm sm:p-10">
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Pelanggan</p>
            <h1 class="mt-2 font-serif text-3xl font-bold">Buat akun</h1>
            <p class="mt-2 text-sm text-slate-600">Pendaftaran publik hanya membuat akun pelanggan.</p>
            <form method="POST" action="{{ route('register.store') }}" class="mt-7 space-y-5">
                @csrf
                <div>
                    <label for="name" class="mb-1 block text-sm font-semibold">Nama lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label for="email" class="mb-1 block text-sm font-semibold">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label for="phone" class="mb-1 block text-sm font-semibold">Nomor telepon (opsional)</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label for="password" class="mb-1 block text-sm font-semibold">Kata sandi (minimal 8 karakter)</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <div>
                    <label for="password_confirmation" class="mb-1 block text-sm font-semibold">Ulangi kata sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>
                <button type="submit" class="w-full rounded-xl bg-brand-700 px-5 py-3 font-semibold text-white hover:bg-brand-800">Daftar sebagai pelanggan</button>
            </form>
        </div>
    </section>
@endsection