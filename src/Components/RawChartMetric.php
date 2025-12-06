<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use MoonShine\Apexcharts\Traits\WithPalette;
use MoonShine\Apexcharts\Traits\WithColors;
use MoonShine\Apexcharts\Traits\WithEvents;
use MoonShine\Apexcharts\Traits\WithHeight;

class RawChartMetric extends ApexChartMetric
{
    use WithPalette;
    use WithColors;
    use WithEvents;
    use WithHeight;

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

        if ($this->getHeight() !== null) {
            $config['chart']['height'] = $this->getHeight();
        } elseif (!isset($config['chart']['height'])) {
            $config['chart']['height'] = $this->getDefaultHeight('raw');
        }

        // Handle colors and palette with proper priority
        // Colors have priority over palette
        if ($this->hasColors()) {
            $config['colors'] = $this->getColors();
        } elseif ($this->getPalette() !== null) {
            $config['theme']['palette'] = $this->getPalette();
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
