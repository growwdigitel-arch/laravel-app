<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // Check if table exists to avoid issues during migration
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::all()->pluck('value', 'key');

                // Override Mail Config
                if ($settings->has('smtp_host')) {
                    config([
                        'mail.mailers.smtp.host' => $settings['smtp_host'],
                        'mail.mailers.smtp.port' => $settings['smtp_port'] ?? 587,
                        'mail.mailers.smtp.username' => $settings['smtp_username'] ?? null,
                        'mail.mailers.smtp.password' => $settings['smtp_password'] ?? null,
                        'mail.mailers.smtp.encryption' => $settings['smtp_encryption'] ?? 'tls',
                        'mail.from.address' => $settings['smtp_from_address'] ?? config('mail.from.address'),
                        'mail.from.name' => $settings['smtp_from_name'] ?? config('mail.from.name'),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Log error or ignore if DB connection fails (e.g. during initial setup)
        }

        // Register Blade Directive for Visual Editor
        \Illuminate\Support\Facades\Blade::directive('editable', function ($expression) {
            return "<?php if(request('edit_mode')) { echo 'contenteditable=\"true\" data-setting-key=\"' . $expression . '\"'; } ?>";
        });
    }
}
