<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('cache:clear-all', function () {
    $this->call('cache:clear');
    $this->call('route:clear');
    $this->call('config:clear');
    $this->call('view:clear');
    $this->info('All caches cleared.');
})->purpose('Clear all Laravel caches');

Artisan::command('make:admin-user', function () {
    $name     = $this->ask('Admin name');
    $email    = $this->ask('Admin email');
    $password = $this->secret('Admin password');

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error('Invalid email address.');
        return;
    }

    $user = \App\Models\User::create([
        'name'     => $name,
        'email'    => $email,
        'password' => bcrypt($password),
        'role'     => 'admin',
    ]);

    $this->info("Admin created: {$user->email} (ID: {$user->id})");
})->purpose('Create a new admin user');
