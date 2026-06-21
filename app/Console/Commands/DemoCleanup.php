<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('app:demo-cleanup')]
#[Description('Delete demo data older than 5 minutes')]
class DemoCleanup extends Command
{
    public function handle(): int
    {
        $tables = ['articles', 'products', 'galleries', 'company_profiles', 'dc_highlights', 'energy_metrics', 'facility_systems'];
        $deleted = 0;

        foreach ($tables as $table) {
            $count = DB::table($table)
                ->where('is_demo', true)
                ->where('created_at', '<', now()->subMinutes(5))
                ->delete();
            $deleted += $count;
        }

        if ($deleted > 0) {
            $this->info("Deleted {$deleted} demo records older than 5 minutes.");
        }

        return self::SUCCESS;
    }
}
