<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * class Token
 *
 * @property int       id
 * @property int       user_id
 * @property string    my_id
 * @property string    uuid
 * @property string    token
 * @property Carbon    expired
 *
 * @property-read User user
 *
 * @package App\Models
 */
class Token extends Base
{
    protected $table = 'tokens';

    /**
     * 关联用户
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
