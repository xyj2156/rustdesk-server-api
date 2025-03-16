<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * class Connection
 *
 * @property int        id   连接ID
 * @property string     uuid uuid
 * @property int        conn_id
 * @property string     ip
 * @property int        session_id
 * @property null       $updated_at
 *
 * @property-read Token token
 *
 * @package App\Models
 */
class Connection extends Base
{
    public const UPDATED_AT = null;

    protected $table = 'connections';

    public function token(): BelongsTo
    {
        return $this->belongsTo(Token::class, 'uuid', 'uuid');
    }
}
