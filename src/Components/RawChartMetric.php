<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;

class RawChartMetric extends ApexChartMetric
{

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

        if ($this->hasHeight()) {
            $config['chart']['height'] = $this->getHeight();
        } elseif (!isset($config['chart']['height'])) {
            $config['chart']['height'] = $this->getDefaultHeight('raw');
        }

        if ($this->hasColors()) {
            $config['colors'] = $this->getColors();
        }

        if ($this->hasTheme()) {
            $config['theme'] = $this->getThemeArray();
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
