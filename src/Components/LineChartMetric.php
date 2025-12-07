<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Illuminate\Support\Collection;
use MoonShine\Apexcharts\Support\SeriesItem;

class LineChartMetric extends ApexChartMetric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.line-chart';

    /** @var array<int, SeriesItem> */
    protected array $series = [];

    protected bool $withoutSortKeys = false;

    /**
     * @param SeriesItem|array<int,SeriesItem> $series
     */
    public function series(array|SeriesItem $series): static
    {
        if (is_array($series)) {
            foreach ($series as $seriesItem) {
                $this->series[] = $seriesItem;
            }
        } else {
            $this->series[] = $series;
        }

        return $this;
    }

    public function getLabels(): array
    {
        return collect($this->getSeries())
            ->mapWithKeys(
                static fn (SeriesItem $seriesItem): array => [
                    $seriesItem->getName() => $seriesItem->getData()
                ]
            )
            ->collapse()
            ->when(! $this->isWithoutSortKeys(), static fn ($items): Collection => $items->sortKeys())
            ->keys()
            ->toArray();
    }

    public function getSeries(): array
    {
        return $this->series;
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
     * @return array<array>
     */
    protected function getSeriesArray(): array
    {
        $result = [];

        foreach ($this->getSeries() as $seriesItem) {
            $result[] = $seriesItem->toArray();
        }

        return $result;
    }

    public function getConfig(): array
    {
        $config = [
            'series' => $this->getSeriesArray(),
            'labels' => $this->getLabels(),
            'chart' => [
                'type' => 'line',
                'height' => $this->getHeight() ?? $this->getDefaultHeight('line'),
                'foreColor' => '#6b7280',
            ],
            'yaxis' => [
                'title' => [
                    'text' => $this->label,
                    'style' => [
                        'fontWeight' => 400,
                        'color' => '#6b7280',
                    ],
                ],
                'labels' => [
                    'style' => [
                        'colors' => '#6b7280',
                    ],
                ],
            ],
            'xaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#6b7280',
                    ],
                ],
            ],
            'legend' => [
                'labels' => [
                    'colors' => '#6b7280',
                ],
            ],
        ];

        if ($this->hasColors()) {
            $config['colors'] = $this->getColors();
        }

        $config['theme'] = $this->getThemeArray();

        return $config;
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            ...parent::viewData(),
            'config' => $this->getConfig(),
            'events' => $this->getEvents(),
        ];
    }
}
