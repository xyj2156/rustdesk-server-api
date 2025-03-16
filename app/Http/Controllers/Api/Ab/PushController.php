<?php

namespace App\Http\Controllers\Api\Ab;

use Illuminate\Http\Request;

/**
 * class IndexController
 *
 * @package App\Http\Controllers\Api\Ab
 */
class PushController
{
    public function __invoke(Request $request): array
    {
        $user   = auth()->user();
        $params = $request->only(
            'data.tags', 'data.peers', 'data.tag_peers'
        );
        return [
            'result' => $user,
        ];
    }
}
