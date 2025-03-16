<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $url     = $request->fullUrl();
        $data    = $request->all();
        $method  = $request->method();
        $headers = $request->header();
        $ip      = $request->ip();

        /** @var Response $response */
        $response = $next($request);

        $content = null;
        if (($response->isSuccessful())) {
            $content = $response->getContent();
        }

        $log = logger()->channel('access');
        $log->info('================== - 请求数据 - ==================');
        $log->info("[$method] $url $ip");
        $log->info("request header:" . json_encode($headers));
        $log->info('request body:' . json_encode($data));
        $log->info('response status:' . $response->getStatusCode());
        if ($content) {
            $log->info('response body:' . $content);
        }
        return $response;
    }
}
