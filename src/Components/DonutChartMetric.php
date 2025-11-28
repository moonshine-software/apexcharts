<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;

class DonutChartMetric extends ApexChartMetric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.donut-chart';

    protected array $values = [];

    protected int $decimals = 3;

    protected int $height = 350;

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

    public function withoutWrapper(): static
    {
        $this->customView('moonshine-apexcharts::components.metrics.donut');

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
            'values' => $this->getValues(),
            'decimals' => $this->getDecimals(),
        ];
    }
}
