<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

use Closure;
use MoonShine\Apexcharts\Support\ChartTheme;

trait WithColorScheme
{
    protected array $colors = [];
    protected ?string $palette = null;
    protected ?ChartTheme $theme = null;

    public function theme(
        int|string|Closure|null $palette = null,
        bool $modeLight = false,
        bool $monochromeEnabled = false,
        bool $monochromeLight = false,
        ?string $monochromeColor = null,
        float $monochromeShadeIntensity = 0.65
    ): static {
        $this->theme = ChartTheme::make(
            $palette,
            $modeLight,
            $monochromeEnabled,
            $monochromeLight,
            $monochromeColor,
            $monochromeShadeIntensity
        );

        return $this;
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
     * @param int|string|Closure $palette
     */
    public function palette(int|string|Closure $palette): static
    {
        $value = $palette instanceof Closure ? $palette() : $palette;

        if (is_numeric($value)) {
            $number = (int) $value;
            if ($number < 1 || $number > 10) {
                throw new \InvalidArgumentException("Palette number must be between 1 and 10, got {$number}");
            }
            $this->palette = "palette{$number}";
        } else {
            $this->palette = $value;
        }

        return $this;
    }

    /**
     * Get chart colors
     *
     * @return string[]
     */
    public function getColors(): array
    {
        return $this->colors;
    }

    public function hasColors(): bool
    {
        return !empty($this->colors);
    }

    public function getPalette(): ?string
    {
        return $this->palette;
    }

    public function hasPalette(): bool
    {
        return $this->palette !== null;
    }

    protected function getDefaultPalette(): string
    {
        return config('moonshine_apexcharts.default_palette', 'palette6');
    }

    protected function getThemeArray(): array
    {
        if ($this->theme === null) {
            $this->theme = ChartTheme::make();
        }

        return $this->theme->toArray();
    }
}
