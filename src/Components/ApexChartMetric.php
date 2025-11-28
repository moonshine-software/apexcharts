<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

abstract class ApexChartMetric extends Metric
{
    protected array $colors = [];

    protected string $palette = '';

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

    /**
     * @param int|string|Closure $palette
     */
    public function palette(int|string|Closure $palette): static
    {
        $paletteValue = $palette instanceof Closure ? $palette() : $palette;

        if (is_numeric($paletteValue)) {
            $paletteNumber = (int)$paletteValue;
            if ($paletteNumber < 1 || $paletteNumber > 10) {
                throw new \InvalidArgumentException("Palette number must be between 1 and 10, got {$paletteNumber}");
            }
            $this->palette = 'palette' . $paletteNumber;
        } else {
            $this->palette = $paletteValue;
        }

        return $this;
    }

    public function getPalette(): string
    {
        return $this->palette ?: config('moonshine_apexcharts.default_palette', 'palette6');
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
            'palette' => $this->getPalette(),
            'height' => $this->height,
            'events' => $this->getEvents(),
        ];
    }
}
