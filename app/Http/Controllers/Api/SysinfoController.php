<?php

namespace App\Http\Controllers\Api;

use App\Models\Sysinfo;
use Illuminate\Http\Request;

/**
 * class SysteminfoController
 *
 * @package App\Http\Controllers\Api
 */
class SysinfoController
{
    public function __invoke(Request $request): array
    {
        $params              = $request->validate([
            'id'       => 'required|numeric',
            'uuid'     => 'required|string|size:48',
            'version'  => 'required|string',
            'hostname' => 'required|string',
            'os'       => 'required|string',
            'cpu'      => 'required|string',
            'memory'   => 'required|string',
        ]);
        $params['device_id'] = $params['id'];
        unset($params['id']);
        Sysinfo::query()->create($params);
        return ['status' => 0, 'msg' => 'ok'];
    }
}
