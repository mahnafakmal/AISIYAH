<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

#[Signature('app:create-staff-user {role=admin}')]
#[Description('Create an administrator, leader, or regional PIC account')]
class CreateStaffUser extends Command
{
    public function handle(): int
    {
        $role = (string) $this->argument('role');

        if (! in_array($role, ['admin', 'pimpinan', 'pic'], true)) {
            $this->error('Role harus admin, pimpinan, atau pic.');

            return self::FAILURE;
        }

        $name = $this->ask('Nama pengguna');
        $email = $this->ask('Email');
        $phone = $this->ask('Nomor telepon (opsional)');
        $region = $role === 'pic' ? $this->ask('Nama Karesidenan') : null;
        $password = $this->secret('Kata sandi (minimal 12 karakter)');
        $passwordConfirmation = $this->secret('Ulangi kata sandi');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'region' => $region,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'region' => [Rule::requiredIf($role === 'pic'), 'nullable', 'string', 'max:120'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone ?: null,
            'role' => $role,
            'region' => $region,
            'password' => $password,
        ]);

        $this->info("Akun {$role} berhasil dibuat untuk {$email}.");

        return self::SUCCESS;
    }
}
