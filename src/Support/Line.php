<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Support;

use MoonShine\Support\Traits\Makeable;

class Line
{
    use Makeable;

    private string $name;
    private array $data;
    private ChartType $type = ChartType::LINE;
    private ?string $color = null;

    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function data(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function type(ChartType $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function line(): self
    {
        $this->type = ChartType::LINE;
        return $this;
    }

    public function area(): self
    {
        $this->type = ChartType::AREA;
        return $this;
    }

    public function column(): self
    {
        $this->type = ChartType::COLUMN;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getType(): ChartType
    {
        return $this->type;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'data' => $this->data,
            'type' => $this->type->value,
            'color' => $this->color,
        ];
    }
}
