<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * class PeerTagRelation
 *
 * @property int       peer_id
 * @property int       tag_id
 * @property null      created_at
 * @property null      updated_at
 *
 * @property-read Tag  tag
 * @property-read Peer peer
 *
 * @package App\Models
 */
class PeerTagRelation extends Base
{
    protected $table = 'peer_tag_relation';

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function peer(): BelongsTo
    {
        return $this->belongsTo(Peer::class, 'peer_id');
    }
}
