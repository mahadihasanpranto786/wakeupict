<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\StudentMenuService;

class CheckStudentFeatureActive
{
    /**
     * Handle an incoming request and ensure the student feature is active in database settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $featureKey
     * @return mixed
     */
    public function handle($request, Closure $next, $featureKey = null)
    {
        if ($featureKey && !StudentMenuService::isFeatureEnabled($featureKey)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'This module is currently disabled by administration.',
                ], 403);
            }

            return response()->view('frontend.theme.clasic.student.feature_disabled', [
                'featureKey' => $featureKey,
            ], 403);
        }

        return $next($request);
    }
}
