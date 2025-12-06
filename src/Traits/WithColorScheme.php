<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

use Closure;

trait WithColorScheme
{
    protected array $colors = [];
    protected ?string $palette = null;

    /**
     * Set chart colors
     *
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

    /**
     * Check if colors are set
     */
    public function hasColors(): bool
    {
        return !empty($this->colors);
    }

    public function getPalette(): ?string
    {
        return $this->palette;
    }

    /**
     * Check if palette is set
     */
    public function hasPalette(): bool
    {
        return $this->palette !== null;
    }

    /**
     * Get default palette from config
     */
    protected function getDefaultPalette(): string
    {
        return config('moonshine_apexcharts.default_palette', 'palette6');
    }
}