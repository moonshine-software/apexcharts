<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

use Closure;

trait WithPalette
{
    protected string $palette = '';

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

    public function getPalette(): string
    {
        return $this->palette ?: config('moonshine_apexcharts.default_palette', 'palette6');
    }
}