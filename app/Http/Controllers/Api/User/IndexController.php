<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * class UserController
 *
 * @package App\Http\Controllers\Api
 */
class IndexController
{
    public function __invoke(Request $request): array
    {
        $current   = $request->get('current', 1);
        $page_size = $request->get('pageSize', 10);
        $status    = $request->get('status', 1);

        $pages = User::query()->paginate(
            perPage: $page_size,
            page   : $current
        );

        return [
            'total' => $pages->total(),
            'data'  => $pages->getCollection()->map(function (User $item) {
                return [
                    'name'     => $item->name ?: $item->username,
                    'email'    => $item->email,
                    'note'     => $item->note,
                    'status'   => 1,
                    'is_admin' => false,
                ];
            }),
        ];
    }
}
