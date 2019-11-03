<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SignInService
{
    public function authenticate(string $email, string $password): ?array
    {
        $passwordEncrypted = sha1($password);

        $user = User::where('password', $passwordEncrypted)
                    ->where('email', $email)
                    ->first();
        
        if($user) {
            return [
                'accessToken' => '',
                'user' => [
                    'firstName' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email
                ]
            ];
        }

        return null;
    }
}
