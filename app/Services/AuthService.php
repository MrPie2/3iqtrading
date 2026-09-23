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
        $investor = Investor::where('Email', $credentials['email'])->first();

        if (!$investor || $investor->LockStatus > 0) {
            return false;
        }

        $stored = (string) $investor->Password;
        $valid = false;

        /*
         * Investor accounts come from a legacy table and may contain hashes
         * generated with a different password algorithm (for example Argon2id).
         * Hash::check() intentionally throws when the stored algorithm differs
         * from Laravel's configured driver, so do not let a valid legacy hash
         * become a login error.
         */
        if ($stored !== '') {
            try {
                $valid = Hash::check($credentials['password'], $stored);
            } catch (\\Throwable) {
                $valid = password_verify($credentials['password'], $stored);
            }
        }

        /*
         * Older investor records may still contain a legacy plaintext value.
         * If it matches, immediately upgrade it to the application's current
         * hashing algorithm.
         */
        if (!$valid && $stored !== '' && hash_equals($stored, $credentials['password'])) {
            $valid = true;
        }

        if (!$valid) {
            return false;
        }

        /*
         * Upgrade a valid legacy hash/plaintext password to the current
         * Laravel hashing algorithm after successful authentication.
         */
        if ($stored !== '' && !str_starts_with($stored, '$2y

        Auth::guard('investor')->login($investor, $remember);

        return true;
    }
})) {
            $investor->Password = Hash::make($credentials['password']);
            $investor->save();
        } elseif ($stored !== '' && Hash::needsRehash($stored)) {
            $investor->Password = Hash::make($credentials['password']);
            $investor->save();
        }

        Auth::guard('investor')->login($investor, $remember);

        return true;
    }
}