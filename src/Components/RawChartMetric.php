<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\Apexcharts\Traits\WithPalette;
use MoonShine\Apexcharts\Traits\WithEvents;

class RawChartMetric extends ApexChartMetric
{
    use WithPalette;
    use WithEvents;

    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.raw-data-chart';

    protected array $config = [];

    /**
     * @param array|Closure $config
     */
    public function config(array|Closure $config): static
    {
        $this->config = $config instanceof Closure
            ? $config()
            : $config;

        return $this;
    }

    public function getConfig(): array
    {
        if (empty($this->config)) {
            return [];
        }

        $config = $this->config;

        if (!isset($config['chart']['height'])) {
            $config['chart']['height'] = 300;
        }

        $palette = $this->getPalette();
        if ($palette && !isset($config['theme']['palette'])) {
            $config['theme']['palette'] = $palette;
        }

        return $config;
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            'config' => $this->getConfig(),
            'events' => $this->getEvents(),
        ];
    }
}
