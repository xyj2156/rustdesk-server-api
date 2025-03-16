<?php
/** @var Router $router */

use Illuminate\Routing\Router;

$router->group([
    'namespace' => '\App\Http\Controllers\Api',
], function (Router $router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    $router->post('sysinfo', 'SysinfoController');
    $router->post('heartbeat', 'HeartbeatController');
    $router->get('login-options', 'LoginOptionsController');
    $router->post('login', 'LoginController');

    $router->group(['middleware' => 'auth:rust-desk'], function (Router $router) {
        $router->get('users', 'User\IndexController');
        $router->get('peers', 'PeerController');
        $router->post('currentUser', 'User\CurrentController');
        $router->group(['prefix' => 'ab', 'namespace' => 'Ab'], function (Router $router) {
            $router->get('/', 'PushController');
            $router->post('/', 'PullController');
            $router->post('personal', 'PersonalController');
        });
        $router->post('audit/conn', 'AuditController@conn');

        $router->post('logout', 'LogoutController');
        $router->group([
            'prefix' => 'device-group', 'namespace' => 'DeviceGroup',
        ], function (Router $router) {
            $router->get('accessible', 'AccessibleController');
        });
    });
});

