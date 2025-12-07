<?php

namespace MoonShine\Apexcharts\Support;

use Closure;
use MoonShine\Support\Traits\Makeable;

class ChartTheme
{
    use Makeable;

    protected ?string $palette = null;
    protected bool $modeLight = false;
    protected bool $monochromeEnabled = false;
    protected bool $monochromeLight = false;
    protected ?string $monochromeColor = null;
    protected float $monochromeShadeIntensity = 0.65;

    public function __construct(
        int|string|Closure|null $palette = null,
        bool $modeLight = false,
        bool $monochromeEnabled = false,
        bool $monochromeLight = false,
        ?string $monochromeColor = null,
        float $monochromeShadeIntensity = 0.65
    ) {
        $this->palette = $palette ? self::resolvePalette($palette) : null;
        $this->modeLight = $modeLight;
        $this->monochromeEnabled = $monochromeEnabled;
        $this->monochromeLight = $monochromeLight;
        $this->monochromeColor = $monochromeColor;

        if ($monochromeShadeIntensity < 0 || $monochromeShadeIntensity > 1) {
            throw new \InvalidArgumentException("Shade intensity must be between 0 and 1, got {$monochromeShadeIntensity}");
        }

        $this->monochromeShadeIntensity = $monochromeShadeIntensity;
    }

    protected static function resolvePalette(int|string|Closure $value): string
    {
        $value = $value instanceof Closure ? $value() : $value;

        if (is_numeric($value)) {
            $number = (int) $value;
            if ($number < 1 || $number > 10) {
                throw new \InvalidArgumentException("Palette number must be between 1 and 10, got {$number}");
            }
            $palette = "palette{$number}";
        } else {
            $palette = $value;
        }

        return $palette;
    }

    public function toArray(): array
    {
        $theme = [
            'mode' => $this->modeLight ? 'light' : 'dark',
        ];

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
            $theme['palette'] = $this->palette ?? config('moonshine_apexcharts.default_palette', 'palette6');
        }

        return $theme;
    }
}
