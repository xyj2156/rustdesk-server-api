<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;

/**
 * class CurrentController
 *
 * @package App\Http\Controllers\Api\User
 */
class CurrentController
{
    public function __invoke(): array
    {
        /** @var User $user */
        $user = auth()->user();
        return [
            'name'     => $user->name,
            'username' => $user->username,
            'email'    => $user->email,
            'note'     => $user->note,
            'status'   => 1,
            'is_admin' => false,
        ];
    }
}
