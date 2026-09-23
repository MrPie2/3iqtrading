<?php

namespace App\Services;

use App\Models\Investor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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

    public function login(array $credentials, bool $remember = false): bool
    {
        $investor = Investor::where('Email', trim($credentials['email']))->first();

        if (!$investor || (int) $investor->LockStatus > 0) {
            return false;
        }

        $stored = trim((string) $investor->Password);
        $password = (string) $credentials['password'];

        if ($stored === '' || $password === '') {
            return false;
        }

        /*
         * Verify the stored password using PHP's native password verifier first.
         * This supports valid bcrypt, Argon2i and Argon2id hashes regardless of
         * Laravel's currently configured hashing driver.
         */
        $valid = password_verify($password, $stored);

        /*
         * Fall back to Laravel's verifier for any legacy Laravel-compatible
         * hashes that PHP's native verifier does not accept.
         */
        if (!$valid) {
            try {
                $valid = Hash::check($password, $stored);
            } catch (\\Throwable $e) {
                $valid = false;
            }
        }

        /*
         * Some very old investor records may contain the password itself.
         * Upgrade it immediately after successful authentication.
         */
        if (!$valid && hash_equals($stored, $password)) {
            $valid = true;
        }

        if (!$valid) {
            return false;
        }

        /*
         * Upgrade valid legacy hashes/plaintext passwords to Laravel's current
         * application hashing algorithm. password_needs_rehash() avoids calling
         * Laravel's Hash::needsRehash() against a hash using another algorithm.
         */
        $needsUpgrade = !password_get_info($stored)['algo']
            || !password_get_info($stored)['algoName']
            || password_needs_rehash($stored, PASSWORD_DEFAULT);

        if ($needsUpgrade || hash_equals($stored, $password)) {
            $investor->Password = Hash::make($password);
            $investor->save();
        }

        Auth::guard('investor')->login($investor, $remember);

        return true;
    }
}
