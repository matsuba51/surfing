<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class LogVisitMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // 直近5分以内の訪問があるかチェック
        $recentVisit = DB::table('visits')
            ->where('ip_address', $ip)
            ->where('visited_at', '>=', now()->subMinutes(5))
            ->exists();

        if (!$recentVisit) {
            DB::table('visits')->insert([
                'ip_address' => $ip,
                'visited_at' => now(), 
            ]);
        }

        return $next($request);
    }
}
