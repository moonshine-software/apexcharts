<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

class DonutChartMetric extends Metric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.donut-chart';

    protected array $values = [];

    protected array $colors = [];

    protected string $palette = '';

    protected int $decimals = 3;

    protected int $height = 350;

    protected string $events = '';

    protected function assets(): array
    {
        return [
            Js::make('vendor/moonshine-apexcharts/apexcharts.js'),
        ];
    }

    public function getDecimals(): int
    {
        return $this->decimals;
    }

    public function decimals(int $decimals): static
    {
        if (in_array($decimals, range(0, 100), true)) {
            $this->decimals = $decimals;
        }

        return $this;
    }

    /**
     * @param array<string, int|float>|Closure $values
     */
    public function values(array|Closure $values): static
    {
        $this->values = $values instanceof Closure
            ? $values()
            : $values;

        return $this;
    }

    /**
     * @return array<int, mixed>
     */
    public function getValues(): array
    {
        return array_values($this->values);
    }

    public function getLabels(): array
    {
        return array_keys($this->values);
    }

    /**
     * @return string[]
     */
    public function getColors(): array
    {
        return $this->colors;
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
     * @param int|string|Closure $palette
     */
    public function palette(int|string|Closure $palette): static
    {
        $paletteValue = $palette instanceof Closure ? $palette() : $palette;

        // Convert number to palette string
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
        return $this->palette ?: config('moonshine_apexcharts.default_palette', 'palette5');
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
            'labels' => $this->getLabels(),
            'values' => $this->getValues(),
            'colors' => $this->getColors(),
            'palette' => $this->getPalette(),
            'decimals' => $this->getDecimals(),
            'height' => $this->height,
            'events' => $this->getEvents(),
        ];
    }
}
