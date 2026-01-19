<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

class SparklineChartMetric extends ApexChartMetric
{
    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.sparkline-chart';

    protected array $values = [];

    protected string $curve = 'smooth';

    protected bool $gradientEnabled = true;

    protected float $gradientOpacityFrom = 0.4;

    protected float $gradientOpacityTo = 0.1;

    protected int $strokeWidth = 2;

    protected bool $tooltipEnabled = true;

    protected string|int|float|null $currentValue = null;

    protected string|int|float|null $changeValue = null;

    protected ?string $valuePrefix = null;

    protected ?string $valueSuffix = null;

    protected ?string $changePrefix = null;

    protected ?string $changeSuffix = null;

    protected ?string $increaseText = 'increase';

    protected ?string $decreaseText = 'decrease';

    /**
     * @param array<int|float> $values
     */
    public function values(array $values): static
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param 'smooth'|'straight'|'stepline'|'monotoneCubic' $curve
     */
    public function curve(string $curve): static
    {
        $this->curve = $curve;

        return $this;
    }

    public function straight(): static
    {
        return $this->curve('straight');
    }

    public function gradient(bool $enabled = true, float $opacityFrom = 0.4, float $opacityTo = 0.1): static
    {
        $this->gradientEnabled = $enabled;
        $this->gradientOpacityFrom = $opacityFrom;
        $this->gradientOpacityTo = $opacityTo;

        return $this;
    }

    public function withoutGradient(): static
    {
        return $this->gradient(false);
    }

    public function strokeWidth(int $width): static
    {
        $this->strokeWidth = $width;

        return $this;
    }

    public function withoutTooltip(): static
    {
        $this->tooltipEnabled = false;

        return $this;
    }

    public function withoutWrapper(): static
    {
        $this->customView('moonshine-apexcharts::components.metrics.sparkline');

        return $this;
    }

    /**
     * Set the current/main value to display
     */
    public function value(string|int|float $value, ?string $prefix = null, ?string $suffix = null): static
    {
        $this->currentValue = $value;
        $this->valuePrefix = $prefix;
        $this->valueSuffix = $suffix;

        return $this;
    }

    /**
     * Set the change value (positive = increase, negative = decrease)
     */
    public function change(string|int|float $value, ?string $prefix = null, ?string $suffix = null): static
    {
        $this->changeValue = $value;
        $this->changePrefix = $prefix;
        $this->changeSuffix = $suffix;

        return $this;
    }

    /**
     * Set custom text for increase/decrease labels
     */
    public function changeText(string $increase, string $decrease): static
    {
        $this->increaseText = $increase;
        $this->decreaseText = $decrease;

        return $this;
    }

    /**
     * Hide increase/decrease text, show only value
     */
    public function withoutChangeText(): static
    {
        $this->increaseText = null;
        $this->decreaseText = null;

        return $this;
    }

    protected function getFormattedValue(): ?string
    {
        if ($this->currentValue === null) {
            return null;
        }

        return ($this->valuePrefix ?? '') . $this->currentValue . ($this->valueSuffix ?? '');
    }

    protected function getFormattedChange(): ?string
    {
        if ($this->changeValue === null) {
            return null;
        }

        $absValue = is_numeric($this->changeValue) ? abs((float) $this->changeValue) : $this->changeValue;

        return ($this->changePrefix ?? '') . $absValue . ($this->changeSuffix ?? '');
    }

    protected function isPositiveChange(): bool
    {
        if (! is_numeric($this->changeValue)) {
            return true;
        }

        return (float) $this->changeValue >= 0;
    }

    protected function getChangeText(): ?string
    {
        if ($this->isPositiveChange()) {
            return $this->increaseText;
        }

        return $this->decreaseText;
    }

    private function getConfig(): array
    {
        $config = [
            'series' => [
                [
                    'data' => $this->values,
                ],
            ],
            'chart' => [
                'type' => 'area',
                'height' => $this->getHeight() ?? 80,
                'sparkline' => [
                    'enabled' => true,
                ],
            ],
            'stroke' => [
                'curve' => $this->curve,
                'width' => $this->strokeWidth,
            ],
            'tooltip' => [
                'enabled' => $this->tooltipEnabled,
                'fixed' => [
                    'enabled' => false,
                ],
                'x' => [
                    'show' => false,
                ],
                'marker' => [
                    'show' => false,
                ],
            ],
        ];

        if ($this->gradientEnabled) {
            $config['fill'] = [
                'type' => 'gradient',
                'gradient' => [
                    'shadeIntensity' => 1,
                    'opacityFrom' => $this->gradientOpacityFrom,
                    'opacityTo' => $this->gradientOpacityTo,
                    'stops' => [0, 100],
                ],
            ];
        }

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
            'formattedValue' => $this->getFormattedValue(),
            'formattedChange' => $this->getFormattedChange(),
            'isPositiveChange' => $this->isPositiveChange(),
            'changeText' => $this->getChangeText(),
        ];
    }
}
