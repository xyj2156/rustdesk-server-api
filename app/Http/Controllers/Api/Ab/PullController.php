<?php

namespace App\Http\Controllers\Api\Ab;

use App\Models\Peer;
use App\Models\Tag;
use App\Models\User;

/**
 * class PullController
 *
 * @package App\Http\Controllers\Api\Ab
 */
class PullController
{
    public function __invoke(): array
    {
        /** @var User $user */
        $user = auth()->user();

        $tags = $user->tags()->chunkMap(function (Tag $tag) {
            return [
                'id'    => $tag->id,
                'tag'   => $tag->tag,
                'color' => $tag->color,
            ];
        });

        $peers = $user->peers()->with(
            'tagRelation'
        )->chunkMap(function (Peer $peer) use ($tags) {
            return [
                'id'       => $peer->id,
                'hash'     => $peer->hash,
                'username' => $peer->username,
                'hostname' => $peer->hostname,
                'platform' => $peer->platform,
                'alias'    => $peer->alias,
                'tags'     => $tags->whereIn(
                    'id',
                    $peer->tagRelation->pluck('tag_id')
                )->pluck('tag'),
            ];
        });
        return [
            'licensed_devices' => 0,
            'data'             => [
                'peers'      => $peers,
                'tags'       => $tags->pluck('tag'),
                'tag_colors' => $tags->pluck('color', 'tag'),
            ],
        ];
    }
}
