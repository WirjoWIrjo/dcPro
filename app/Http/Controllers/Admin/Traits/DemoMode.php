<?php

namespace App\Http\Controllers\Admin\Traits;

trait DemoMode
{
    protected function isDemoRecord(): bool
    {
        $userId = session('admin_id');
        if (!$userId) {
            return true;
        }

        $user = \App\Models\User::find($userId);
        return $user && $user->role === 'owner' ? false : true;
    }
}
