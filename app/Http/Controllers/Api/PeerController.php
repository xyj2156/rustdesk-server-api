<?php

namespace App\Http\Controllers\Api;

use App\Models\Peer;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * class PeerController
 *
 * @package App\Http\Controllers\Api
 */
class PeerController
{
    public function __invoke(Request $request): array
    {
        /** @var User $user */
        $user      = $request->user();
        $current   = $request->get('current', 1);
        $page_size = $request->get('pageSize', 10);

        $peers = $user->peers()->paginate(perPage: $page_size, page: $current);

        $user_arr = [
            'name'     => $user->name ?: $user->username,
            'email'    => $user->email,
            'note'     => $user->note,
            'status'   => 1,
            'is_admin' => false,
        ];
        return [
            'total' => $peers->total(),
            'data'  => $peers->getCollection()->map(function (Peer $peer) use ($user_arr) {
                return [
                    'id'        => $peer->peer_id,
                    'user_name' => $peer->username,
                    'status'    => 1,
                    'info'      => [
                        'username'    => $peer->username,
                        'os'          => $peer->platform,
                        'device_name' => $peer->hostname,
                    ],
                    'user'      => $user_arr,
                ];
            }),
        ];
    }
}
