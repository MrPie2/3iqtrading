<?php

namespace App\Services;

use App\Models\Investor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AuthService
{
    public function register(array $data): Investor
    {
        if (!Schema::hasTable('investors')) {
            throw new \RuntimeException('The investors table is not available. Configure the legacy investor database before registering clients.');
        }

        $columns = array_flip(Schema::getColumnListing('investors'));
        $attributes = [];

        $values = [
            'Investor_id' => random_int(10000000, 999999999),
            'First_Name' => $data['name'],
            'Email' => $data['email'],
            'Username' => $data['email'],
            'Password' => Hash::make($data['password']),
            'Phone' => '',
            'Nationality' => '',
            'Account_Type' => 'Individual',
            'Total_Deposit' => 0,
            'Fin_Asset' => 0,
            'Status' => 1,
            'V_Status' => 0,
            'LockStatus' => 0,
            'exchangerate' => 1,
            'curName' => 'US Dollar',
            'curAbbr' => '$',
            'Profile_Picture' => null,
        ];

        foreach ($values as $column => $value) {
            if (isset($columns[$column])) {
                $attributes[$column] = $value;
            }
        }

        $investor = Investor::create($attributes);

        if (!isset($investor->id)) {
            throw new \RuntimeException('The investor account could not be created.');
        }

        return $investor;
    }

    public function createVerificationToken(Investor $investor): string
    {
        $token = Str::random(64);
        $investor->forceFill(['email_verification_token' => hash('sha256', $token), 'email_verification_expires_at' => now()->addHours(24)])->save();
        return $token;
    }

    public function verifyEmail(string $token): ?Investor
    {
        $investor = Investor::where('email_verification_token', hash('sha256', $token))
            ->where('email_verification_expires_at', '>', now())->first();
        if (!$investor) return null;
        $investor->forceFill(['V_Status' => 1, 'email_verification_token' => null, 'email_verification_expires_at' => null])->save();
        return $investor;
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        $email = trim((string) ($credentials['email'] ?? ''));
        $password = (string) ($credentials['password'] ?? '');

        if ($email === '' || $password === '') {
            return false;
        }

        /*
         * Use a case-insensitive email comparison so existing investor
         * accounts can be accessed even when the login casing differs.
         */
        $investor = Investor::whereRaw('LOWER(TRIM(Email)) = LOWER(?)', [$email])->first();

        if (!$investor || (int) $investor->LockStatus > 0 || (int) $investor->V_Status !== 1) {
            return false;
        }

        $stored = trim((string) $investor->Password);

        if ($stored === '') {
            return false;
        }

        /*
         * PHP's native verifier supports bcrypt, Argon2i and Argon2id
         * independently of Laravel's configured hashing driver.
         */
        $valid = password_verify($password, $stored);

        /*
         * Fall back to Laravel's verifier for Laravel-compatible legacy
         * hashes that PHP does not recognize directly.
         */
        if (!$valid) {
            try {
                $valid = Hash::check($password, $stored);
            } catch (\Throwable $e) {
                $valid = false;
            }
        }

        /*
         * Support legacy plaintext records only as a migration path.
         * A successful plaintext login is immediately converted to a hash.
         */
        $isPlaintext = !$valid && hash_equals($stored, $password);

        if ($isPlaintext) {
            $valid = true;
        }

        if (!$valid) {
            return false;
        }

        /*
         * Upgrade plaintext and valid legacy hashes to the application's
         * current hashing algorithm after successful authentication.
         */
        $hashInfo = password_get_info($stored);
        $isPasswordHash = !empty($hashInfo['algo']);

        if ($isPlaintext || !$isPasswordHash || password_needs_rehash($stored, PASSWORD_DEFAULT)) {
            $investor->Password = Hash::make($password);
            $investor->save();
        }

        Auth::guard('investor')->login($investor, $remember);

        return true;
    }
}
