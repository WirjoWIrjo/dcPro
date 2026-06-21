<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Custom Artisan Commands
|--------------------------------------------------------------------------
|
| This section for registering custom Artisan console commands.
| Each command closure receives the `$this` context of the
| underlying `Illuminate\Console\Command` instance.
|
| Available commands:
|   php artisan inspire
|   php artisan cache:clear-all
|   php artisan make:admin-user
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


/**
 * This command for clearing all Laravel cache stores.
 * It clears application cache, route cache, config cache,
 * and compiled view files.
 */
Artisan::command('cache:clear-all', function () {
    $this->info('Clearing application cache...');
    $this->call('cache:clear');

    $this->info('Clearing route cache...');
    $this->call('route:clear');

    $this->info('Clearing configuration cache...');
    $this->call('config:clear');

    $this->info('Clearing compiled view files...');
    $this->call('view:clear');

    $this->info('All caches have been cleared successfully.');
})->purpose('Clear all Laravel caches (app, route, config, view)');


/**
 * This command for creating a new admin user via console.
 * It prompts for name, email and password, then stores the user.
 */
Artisan::command('make:admin-user', function () {
    $name     = $this->ask('Enter the admin name');
    $email    = $this->ask('Enter the admin e-mail address');
    $password = $this->secret('Enter the admin password');

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error('Invalid e-mail address. Aborting.');
        return;
    }

    $hashedPassword = bcrypt($password);

    $user = \App\Models\User::create([
        'name'     => $name,
        'email'    => $email,
        'password' => $hashedPassword,
        'role'     => 'admin',
    ]);

    $this->info('Admin user created successfully!');
    $this->line("ID: {$user->id}");
    $this->line("Email: {$user->email}");
})->purpose('Create a new admin user via the console');


/**
 * This command for force-running a queued job immediately.
 * Useful for debugging scheduled jobs without waiting for cron.
 */
Artisan::command('schedule:run-now {job}', function ($job) {
    $fullClass = "App\\Jobs\\{$job}";

    if (! class_exists($fullClass)) {
        $this->error("Job class [$fullClass] does not exist.");
        return;
    }

    $this->info("Dispatching {$fullClass} now...");
    dispatch_sync(new $fullClass);

    $this->info('Job executed.');
})->purpose('Run a specific queued job immediately (for debugging)');
