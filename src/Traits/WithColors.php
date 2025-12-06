<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

use Closure;

trait WithColors
{
    protected array $colors = [];

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

    }