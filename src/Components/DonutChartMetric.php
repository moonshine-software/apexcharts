<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\Apexcharts\Traits\WithColorScheme;
use MoonShine\Apexcharts\Traits\WithEvents;
use MoonShine\Apexcharts\Traits\WithHeight;

class DonutChartMetric extends ApexChartMetric
{
    use WithColorScheme;
    use WithEvents;
    use WithHeight;

    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.donut-chart';

    protected array $values = [];

    protected int $decimals = 3;

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

    public function getConfig(): array
    {
        $config = [
            'series' => $this->getValues(),
            'labels' => $this->getLabels(),
            'chart' => [
                'type' => 'donut',
                'height' => $this->getHeight() ?? $this->getDefaultHeight('donut'),
                'background' => 'transparent',
                'foreColor' => '#6a778f',
            ],
            'tooltip' => [
                'y' => [
                    'theme' => 'dark'
                ],
                'theme' => 'dark'
            ],
            'stroke' => [
                'colors' => ['transparent'],
            ],
            'plotOptions' => [
                'pie' => [
                    'expandOnClick' => false,
                    'donut' => [
                        'labels' => [
                            'show' => true,
                            'total' => [
                                'label' => $this->label,
                                'showAlways' => false,
                                'show' => true
                            ]
                        ]
                    ]
                ]
            ],
            'legend' => [
                'position' => 'bottom',
                'offsetY' => 10,
                'itemMargin' => [
                    'horizontal' => 6,
                    'vertical' => 6,
                ],
            ],
        ];

        if ($this->hasColors()) {
            $config['colors'] = $this->getColors();
        } else {
            $config['theme']['mode'] = 'dark';
            $config['theme']['palette'] = $this->getPalette() ?? $this->getDefaultPalette();
        }

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
            'decimals' => $this->getDecimals(),
        ];
    }
}
