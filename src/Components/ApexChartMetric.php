<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

abstract class ApexChartMetric extends Metric
{
    protected function assets(): array
    {
        return [
            Js::make('vendor/moonshine-apexcharts/apexcharts.js'),
        ];
    }
}
