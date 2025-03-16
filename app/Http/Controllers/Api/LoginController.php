<?php

namespace App\Http\Controllers\Api;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * class LoginController
 *
 * @package App\Http\Controllers\Api
 */
class LoginController
{
    public function __invoke(Request $request): array
    {
        try {
            $params = $request->validate([
                'username'   => 'required|string',
                'password'   => 'required|string',
                'id'         => 'required|numeric',
                'uuid'       => 'required|string|size:48',
                'autoLogin'  => 'nullable|boolean',
                'type'       => 'required|string', // 登录类型
                'deviceInfo' => 'nullable|array',
            ]);
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }

        /** @var User $user */
        $user = User::query()->where(
            'username', $params['username']
        )->first();
        if (!$user) {
            return ['error' => '用户不存在'];
        }
        if (!password_verify($request->input('password'), $user->password)) {
            return ['error' => '密码错误'];
        }

//        创建 token
        $access_token = hash('sha256', $user->username . $params['uuid'] . time());
//        生成或更新 token
        Token::query()->updateOrCreate([
            'my_id' => $params['id'],
        ], [
            'uuid'    => $params['uuid'],
            'user_id' => $user->id,
            'token'   => $access_token,
            'expired' => now()->addYear(),
        ]);

        return [
            'access_token' => $access_token,
            'type'         => 'access_token',
            'user'         => [
                'name'     => $user->name ?: $user->username,
                'email'    => $user->email ?: 'example@example.com',
                'note'     => $user->note ?: '',
                'is_admin' => false,
            ],
        ];
    }
}
