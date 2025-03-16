<?php

namespace App\Http\Controllers\Api;

use App\Models\Connection;
use Illuminate\Http\Request;

/**
 * class AuditController
 *
 * @package App\Http\Controllers\Api
 */
class AuditController
{
    public function conn(Request $request): array
    {
        $params = $request->validate([
            'action'     => 'required|in:new,close',
            'conn_id'    => 'required|integer',
            'ip'         => 'required|ip',
            'session_id' => 'required|integer',
            'uuid'       => 'required|string|size:64',
        ]);
        $action = $params['action'];
        unset($params['action']);
        if ($action === 'new') {
            Connection::query()->create($params);
            return ['ok'];
        }
        Connection::query()->where(['uuid' => $params['uuid']])->delete();
        return ['ok'];
    }
}
