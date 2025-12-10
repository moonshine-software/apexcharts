<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use MoonShine\AssetManager\Js;
use MoonShine\Apexcharts\Traits\WithColorScheme;
use MoonShine\Apexcharts\Traits\WithEvents;
use MoonShine\Apexcharts\Traits\WithHeight;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

abstract class ApexChartMetric extends Metric
{
    use WithColorScheme;
    use WithEvents;
    use WithHeight;

    protected function assets(): array
    {
        return [
            Js::make('vendor/moonshine-apexcharts/apexcharts.js'),
        ];
    }
}
