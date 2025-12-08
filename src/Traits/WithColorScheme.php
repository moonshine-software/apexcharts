<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

use Closure;
use MoonShine\Apexcharts\Support\ChartTheme;

trait WithColorScheme
{
    protected array $colors = [];
    protected ?ChartTheme $theme = null;

    public function theme(
        int|Closure|null $palette = null,
        bool $monochromeEnabled = false,
        bool $monochromeLight = false,
        ?string $monochromeColor = null,
        float $monochromeShadeIntensity = 0.65
    ): static {
        $this->theme = ChartTheme::make(
            $palette,
            $monochromeEnabled,
            $monochromeLight,
            $monochromeColor,
            $monochromeShadeIntensity
        );

        return $this;
    }

    protected function hasTheme(): bool
    {
        return $this->theme !== null;
    }

    protected function getThemeArray(): array
    {
        if (!$this->hasTheme()) {
            $this->theme = ChartTheme::make();
        }

        return $this->theme->toArray();
    }

    /**
     * Set chart colors
     *
     * @param string[]|Closure $colors
     */
    public function colors(array|Closure $colors): static
    {
        $this->colors = $colors instanceof Closure ? $colors() : $colors;

        return $this;
    }

    /**
     * Get chart colors
     *
     * @return string[]
     */
    protected function getColors(): array
    {
        return $this->colors;
    }

    protected function hasColors(): bool
    {
        return !empty($this->colors);
    }
}
