<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Custom Artisan Commands
|--------------------------------------------------------------------------
|
| Below you can register any number of closures that will be turned into
| Artisan console commands.  They are defined directly in a service
| provider (usually `App\Providers\AppServiceProvider::boot`) so they are
| available without creating a full command class.
|
| The first command – **inspire** – already ships with Laravel.  We keep it
| here for demonstration and add a couple of useful custom commands.
|
| Each command closure receives the `$this` context of the underlying
| `Illuminate\Console\Command` instance, letting you call methods such as
| `$this->info()`, `$this->error()`, `$this->comment()`, etc.
|
| --------------------------------------------------------------
| How to run them:
|   php artisan inspire
|   php artisan cache:clear-all   (custom command below)
|   php artisan make:admin-user   (custom command below)
| --------------------------------------------------------------
*/

Artisan::command('inspire', function () {
    // Show a random, inspiring quote in the console.
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



/**
 * ----------------------------------------------------------------------
 * Custom Command: cache:clear-all
 *
 * Clears *all* cache stores (application cache, route cache,
 * configuration cache, view cache, and compiled files).  This is handy
 * during development or after a deployment when you want to be certain
 * the latest compiled assets and config are being used.
 * ----------------------------------------------------------------------
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
 * ----------------------------------------------------------------------
 * Custom Command: make:admin-user
 *
 * Quickly creates a new user with an "admin" role (you must have a
 * `users` table and a `role` column or a related Role model).  The
 * command prompts for name, email and password, validates the input,
 * and stores the user using Eloquent.
 * ----------------------------------------------------------------------
 */
Artisan::command('make:admin-user', function () {
    // Prompt the developer for the required fields.
    $name     = $this->ask('Enter the admin name');
    $email    = $this->ask('Enter the admin e‑mail address');
    $password = $this->secret('Enter the admin password');

    // Simple validation – you could replace this with a FormRequest if you prefer.
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error('Invalid e‑mail address. Aborting.');
        return;
    }

    // Hash the password using Laravel's built‑in bcrypt.
    $hashedPassword = bcrypt($password);

    // Create the user (assumes the App\Models\User model exists).
    $user = \App\Models\User::create([
        'name'     => $name,
        'email'    => $email,
        'password' => $hashedPassword,
        // Adjust the role field name to fit your schema.
        'role'     => 'admin',
    ]);

    // Provide feedback to the developer.
    $this->info('✅ Admin user created successfully!');
    $this->line("ID: {$user->id}");
    $this->line("Email: {$user->email}");
    $this->line('Remember to verify the e‑mail or adjust any additional fields.');
})->purpose('Create a new admin user via the console');



/**
 * ----------------------------------------------------------------------
 * Custom Command: schedule:run-now {job}
 *
 * Force‑run a queued job immediately from the console.  Useful for
 * debugging scheduled jobs without waiting for the cron.
 *
 * Usage:
 *   php artisan schedule:run-now CleanupTempFiles
 * ----------------------------------------------------------------------
 */
Artisan::command('schedule:run-now {job}', function ($job) {
    // Resolve the job class from the App\Jobs namespace.
    $fullClass = "App\\Jobs\\{$job}";

    if (! class_exists($fullClass)) {
        $this->error("Job class [$fullClass] does not exist.");
        return;
    }

    // Dispatch the job synchronously so you see the result instantly.
    $this->info("Dispatching {$fullClass} now...");
    dispatch_sync(new $fullClass);

    $this->info('✅ Job executed.');
})->purpose('Run a specific queued job immediately (for debugging)');