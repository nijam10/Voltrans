<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        $rules = [
            'password' => $this->passwordRules(),
        ];
        $messages = [
            'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'current_password.current_password' => __('Password anda tidak sesuai dengan password saat ini'),
            'current_password.required' => __('silahkan isi terlebih dahulu'),
        ];

        // Only require current_password if user has a password set
        if (!empty($user->password)) {
            $rules['current_password'] = ['required', 'string', 'current_password:web'];
        }

        Validator::make($input, $rules, $messages)->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
        
    }
}
