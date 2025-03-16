<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * class Peer
 *
 * @property int             id
 * @property int             user_id
 * @property int             peer_id
 * @property string          hash
 * @property string          username
 * @property string          hostname
 * @property string          platform
 * @property string          alias
 *
 * @property-read User       user
 * @property-read Collection tags
 * @property-read Collection tagRelation
 *
 * @package App\Models
 */
class Peer extends Base
{
    protected $table = 'peers';

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'peer_tag_relation', 'peer_id', 'tag_id');
    }

    public function tagRelation(): HasMany
    {
        return $this->hasMany(PeerTagRelation::class, 'peer_id');
    }
}
