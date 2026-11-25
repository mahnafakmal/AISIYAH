<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

#[Signature('app:create-staff-user {name} {email} {role=admin} {--region=} {--phone=}')]
#[Description('Create an administrator, leader, or regional PIC account')]
class CreateStaffUser extends Command
{
    public function handle(): int
    {
        $attributes = [
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'role' => $this->argument('role'),
            'region' => $this->option('region'),
            'phone' => $this->option('phone'),
        ];

        $validator = Validator::make($attributes, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:admin,pimpinan,pic'],
            'region' => ['required_if:role,pic', 'nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        $password = $this->secret('Kata sandi akun baru');

        if (! is_string($password) || strlen($password) < 8) {
            $this->error('Kata sandi harus memiliki minimal 8 karakter.');

            return self::FAILURE;
        }

        User::create([
            ...$validator->validated(),
            'password' => $password,
        ]);

        $this->info('Akun staf berhasil dibuat.');

        return self::SUCCESS;
    }
}
