<?php

namespace App\Http\Controllers\Api;

/**
 * class HeartbeatController
 *
 * @package App\Http\Controllers\Api
 */
class HeartbeatController
{
    public function __invoke(): array
    {
        return ['modified_at' => time()];
    }
}
