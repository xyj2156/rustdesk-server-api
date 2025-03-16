<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * class Tag
 *
 * @property int             id
 * @property int             user_id
 * @property string          tag
 * @property int             color
 *
 * @property-read User       user
 * @property-read Collection peers
 *
 * @package App\Models
 */
class Tag extends Base
{
    protected $table = 'tags';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function peers(): BelongsToMany
    {
        return $this->belongsToMany(Peer::class, 'peer_tag_relation', 'tag_id', 'peer_id');
    }
}
