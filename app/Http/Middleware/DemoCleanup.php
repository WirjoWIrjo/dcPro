<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoCleanup
{
    public function handle(Request $request, Closure $next)
    {
        $this->cleanup();

        return $next($request);
    }

    private function cleanup(): void
    {
        $lockFile = sys_get_temp_dir() . '/demo_cleanup.lock';

        if (file_exists($lockFile) && (time() - filemtime($lockFile)) < 60) {
            return;
        }

        touch($lockFile);

        $tables = ['articles', 'products', 'galleries', 'company_profiles', 'dc_highlights', 'energy_metrics', 'facility_systems'];

        foreach ($tables as $table) {
            DB::table($table)
                ->where('is_demo', true)
                ->where('created_at', '<', now()->subMinutes(5))
                ->delete();
        }
    }
}
