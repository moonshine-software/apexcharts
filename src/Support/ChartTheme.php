<?php

namespace MoonShine\Apexcharts\Support;

use Closure;
use MoonShine\Support\Traits\Makeable;

class ChartTheme
{
    use Makeable;

    protected ?int $palette = null;
    protected bool $monochromeEnabled = false;
    protected bool $monochromeLight = false;
    protected ?string $monochromeColor = null;
    protected float $monochromeShadeIntensity = 0.65;

    public function __construct(
        int|Closure|null $palette = null,
        bool $monochromeEnabled = false,
        bool $monochromeLight = false,
        ?string $monochromeColor = null,
        float $monochromeShadeIntensity = 0.65
    ) {
        $this->palette = $palette ? self::resolvePalette($palette) : null;
        $this->monochromeEnabled = $monochromeEnabled;
        $this->monochromeLight = $monochromeLight;
        $this->monochromeColor = $monochromeColor;

        if ($monochromeShadeIntensity < 0 || $monochromeShadeIntensity > 1) {
            throw new \InvalidArgumentException("Shade intensity must be between 0 and 1, got {$monochromeShadeIntensity}");
        }

        $this->monochromeShadeIntensity = $monochromeShadeIntensity;
    }

    private static function resolvePalette(int|Closure $number): int
    {
        $number = $number instanceof Closure ? $number() : $number;

        if ($number < 1 || $number > 10) {
            throw new \InvalidArgumentException("Palette number must be between 1 and 10, got $number");
        }

        return $number;
    }

    public function toArray(): array
    {
        $theme = [];

        if ($this->monochromeEnabled) {
            $theme['monochrome'] = [
                'enabled' => true,
                'shadeTo' => $this->monochromeLight ? 'light' : 'dark',
                'shadeIntensity' => $this->monochromeShadeIntensity,
            ];

            if ($this->monochromeColor !== null) {
                $theme['monochrome']['color'] = $this->monochromeColor;
            }
        } else {
            $theme['palette'] = $this->palette ?? config('moonshine_apexcharts.default_palette', 6);
        }

        return $theme;
    }
}
