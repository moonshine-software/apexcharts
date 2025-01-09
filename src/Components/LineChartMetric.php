<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use Illuminate\Support\Collection;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;

class LineChartMetric extends Metric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.line-chart';

    protected array $lines = [];

    protected array $colors = [];

    protected bool $withoutSortKeys = false;

    protected int $height = 300;

    protected function assets(): array
    {
        return [
            Js::make('vendor/moonshine-apexcharts/apexcharts.js'),
        ];
    }

    /**
     * @param  array<string, array<numeric>>|Closure  $line
     * @param  string|string[]|Closure  $color
     */
    public function line(
        array|Closure $line,
        string|array|Closure $color = '#7843E9'
    ): static {
        $this->lines[] = $line instanceof Closure ? $line() : $line;

        $color = $color instanceof Closure ? $color() : $color;

        if (is_string($color)) {
            $this->colors[] = $color;
        } else {
            $this->colors = $color;
        }

        return $this;
    }

    public function getColor(int $index): string
    {
        return $this->colors[$index];
    }

    public function getColors(): array
    {
        return $this->colors;
    }

    public function getLabels(): array
    {
        return collect($this->getLines())
            ->collapse()
            ->mapWithKeys(static fn ($item): mixed => $item)
            ->when(! $this->isWithoutSortKeys(), static fn ($items): Collection => $items->sortKeys())
            ->keys()
            ->toArray();
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function withoutSortKeys(): static
    {
        $this->withoutSortKeys = true;

        return $this;
    }

    public function isWithoutSortKeys(): bool
    {
        return $this->withoutSortKeys;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            'labels' => $this->getLabels(),
            'lines' => $this->getLines(),
            'colors' => $this->getColors(),
            'height' => $this->height,
        ];
    }
}
