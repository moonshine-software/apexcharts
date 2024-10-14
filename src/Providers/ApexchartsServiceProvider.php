<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Providers;

use Illuminate\Support\ServiceProvider;

final class ApexchartsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'moonshine-apexcharts');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/moonshine-apexcharts'),
        ], ['moonshine-apexcharts-assets', 'laravel-assets']);
    }
}
