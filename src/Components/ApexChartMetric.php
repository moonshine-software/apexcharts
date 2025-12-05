<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

abstract class ApexChartMetric extends Metric
{
    protected array $colors = [];

    protected int $height;

    protected string $events = '';

    protected function assets(): array
    {
        return [
            Js::make('vendor/moonshine-apexcharts/apexcharts.js'),
        ];
    }

    /**
     * @param string[]|Closure $colors
     */
    public function colors(array|Closure $colors): static
    {
        $this->colors = $colors instanceof Closure
            ? $colors()
            : $colors;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getColors(): array
    {
        return $this->colors;
    }

    
    public function height(int|string $height): static
    {
        $this->height = (int)$height;

        return $this;
    }

    public function setEvents(string $events): static
    {
        $this->events = $events;

        return $this;
    }

    public function getEvents(): string
    {
        if($this->events === '') {
            return <<<JS
            {}
            JS;
        }

        return $this->events;
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            'colors' => $this->getColors(),
            'height' => $this->height,
            'events' => $this->getEvents(),
        ];
    }
}
