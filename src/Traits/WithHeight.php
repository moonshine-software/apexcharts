<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

trait WithHeight
{
    protected ?int $height = null;

    /**
     * Set chart height in pixels
     */
    public function height(int|string $height): static
    {
        $height = (int) $height;

        if ($height < 50) {
            throw new \InvalidArgumentException("Chart height must be at least 50px, got {$height}");
        }

        if ($height > 2000) {
            throw new \InvalidArgumentException("Chart height should not exceed 2000px, got {$height}");
        }

        $this->height = $height;

        return $this;
    }

    /**
     * Get the explicitly set height, null if not set
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Check if height is explicitly set
     */
    public function hasHeight(): bool
    {
        return $this->height !== null;
    }

    /**
     * Get default height from config for a specific chart type
     */
    protected function getDefaultHeight(string $chartType): int
    {
        return config("moonshine_apexcharts.default_heights.{$chartType}")
            ?? config('moonshine_apexcharts.default_height', 300);
    }
}