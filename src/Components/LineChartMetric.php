<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Components;

use Closure;
use Illuminate\Support\Collection;
use MoonShine\Apexcharts\Support\Line;
use MoonShine\Apexcharts\Support\ChartType;
use MoonShine\Apexcharts\Traits\WithPalette;
use MoonShine\Apexcharts\Traits\WithEvents;
use MoonShine\Apexcharts\Traits\WithHeight;

class LineChartMetric extends ApexChartMetric
{
    use WithPalette;
    use WithEvents;
    use WithHeight;

    protected string $view = 'moonshine-apexcharts::components.metrics.wrapped.line-chart';

    /** @var array<int, Line> */
  protected array $lines = [];

    protected bool $withoutSortKeys = false;

    /**
     * @param array<string, array<numeric>>|Closure $line
     * @param string|string[]|Closure|null $color
     * @param string|string[]|Closure $type
     */
    public function line(
        array|Closure $line,
        string|array|Closure $color = null,
        string|array|Closure|ChartType $type = ChartType::LINE
    ): static {
        $linesData = $line instanceof Closure ? $line() : $line;
        $typesData = $type instanceof Closure ? $type() : $type;
        $colorsData = $color instanceof Closure ? $color() : $color;

        // Convert single ChartType to array for compatibility
        if ($typesData instanceof ChartType) {
            $typesData = [$typesData];
        }

        $typeArray = is_array($typesData) ? array_values($typesData) : [$typesData];
        $colorArray = is_array($colorsData) ? array_values($colorsData) : ($colorsData ? [$colorsData] : []);

        $lineIndex = 0;
        foreach ($linesData as $name => $data) {
            // Convert string types to ChartType enum using built-in from() method
            $lineType = $typeArray[$lineIndex] ?? $typeArray[0] ?? ChartType::LINE;

            if (is_string($lineType)) {
                $lineType = ChartType::from($lineType);
            }

            $lineColor = $colorArray[$lineIndex] ?? null;

            $lineObj = Line::make($name, $data)->type($lineType);
            if ($lineColor) {
                $lineObj->color($lineColor);
            }
            $this->lines[] = $lineObj;

            $lineIndex++;
        }

        return $this;
    }

    /**
     * @param Line $line
     */
    public function addLine(Line $line): static
    {
        $this->lines[] = $line;
        return $this;
    }

    /**
     * @param array<int, Line> $lines
     */
    public function addLines(array $lines): static
    {
        foreach ($lines as $line) {
            $this->addLine($line);
        }
        return $this;
    }

    public function getLabels(): array
    {
        return collect($this->getLines())
            ->mapWithKeys(static fn (Line $line): mixed => [$line->getName() => $line->getData()])
            ->collapse()
            ->when(! $this->isWithoutSortKeys(), static fn ($items): Collection => $items->sortKeys())
            ->keys()
            ->toArray();
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function withoutSortKeys(): static
    {
        $this->withoutSortKeys = true;

        return $this;
    }

    public function isWithoutSortKeys(): bool
    {
        return $this->withoutSortKeys;
    }

    public function withoutWrapper(): static
    {
        $this->customView('moonshine-apexcharts::components.metrics.line');

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            ...parent::viewData(),
            'labels' => $this->getLabels(),
            'lines' => $this->getLines(),
            'palette' => $this->getPalette() ?? $this->getDefaultPalette(),
            'events' => $this->getEvents(),
            'height' => $this->getHeight() ?? $this->getDefaultHeight('line'),
        ];
    }
}
