<?php

namespace App\Providers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 添加自定义 guard
        Auth::extend('rust-desk', function ($app, $name, array $config) {
            return new RequestGuard(function (Request $request) {
                $token       = $request->bearerToken();
                $token_model = Token::query()->where('token', $token)->first();
                if (!$token) {
                    throw new \Exception('token is invalid');
                }
                $user = User::query()->where('id', $token_model->user_id)->first();
                $user->setRelation('token', $token_model);
                return $user;
            }, request());
        });
    }
}
