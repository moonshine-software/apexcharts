<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

class ApexChartFromRawData extends Metric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.raw-data-chart';

    protected array $config = [];

    protected string $events = '';

    protected function assets(): array
    {
        return [
            Js::make('vendor/moonshine-apexcharts/apexcharts.js'),
        ];
    }

    public function setEvents(string $events): static
    {
        $this->events = $events;

        return $this;
    }

    public function getEvents(): string
    {
        if ($this->events === '') {
            return <<<JS
            {}
            JS;
        }

        return $this->events;
    }

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
