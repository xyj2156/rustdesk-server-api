<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * class LogoutController
 *
 * @package App\Http\Controllers\Api
 */
class LogoutController
{
    public function __invoke(Request $request)
    {
        $params = $request->validate([
            'id'   => 'required|numeric',
            'uuid' => 'required|string|size:48',
        ]);

        /** @var User $user */
        $user = $request->user();

        $user->tokens()->where('my_id', $params['id'])->where('uuid', $params['uuid'])->delete();

        return ['ok'];
    }
}
