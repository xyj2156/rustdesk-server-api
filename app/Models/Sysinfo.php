<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * class Sysinfo
 *
 * @property int    id
 * @property string device_id
 * @property string uuid
 * @property string version
 * @property string hostname
 * @property string os
 * @property string cpu
 * @property string memory
 *
 * @package App\Models
 */
class Sysinfo extends Base
{
    protected $table = 'sys_info';

    public const UPDATED_AT = null;

    public function token(): BelongsTo
    {
        return $this->belongsTo(Token::class, 'uuid', 'uuid');
    }
}
