<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use Illuminate\Support\Collection;

class LineChartMetric extends ApexChartMetric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.line-chart';

    protected array $lines = [];

    protected array $types = [];

    protected bool $withoutSortKeys = false;

    protected int $height = 300;

    /**
     * @param  array<string, array<numeric>>|Closure  $line
     * @param  string|string[]|Closure|null  $color
     */
    public function line(
        array|Closure $line,
        string|array|Closure $color = null,
        string|array|Closure $type = 'line'
    ): static {
        $lines = $line instanceof Closure ? $line() : $line;
        $this->lines[] = $lines;

        if ($color !== null) {
            $color = $color instanceof Closure ? $color() : $color;

            if (is_array($color)) {
                parent::colors($color);
            } elseif (is_string($color)) {
                $this->colors[] = $color;
            }
        }

        $type = $type instanceof Closure ? $type() : $type;

        if (is_string($type)) {
            $this->types[][] = $type;
        } else {
            $this->types[] = $type;
        }

        return $this;
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

    public function getTypes(): array
    {
        return $this->types;
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

    public function withoutWrapper(): static
    {
        $this->customView('moonshine-apexcharts::components.metrics.line');

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            ...parent::viewData(),
            'labels' => $this->getLabels(),
            'lines' => $this->getLines(),
            'types' => $this->getTypes(),
        ];
    }
}
