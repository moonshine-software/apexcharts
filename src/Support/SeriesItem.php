<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Support;

use MoonShine\Support\Traits\Makeable;

class SeriesItem
{
    use Makeable;

    private string $name;
    private array $data;
    private SeriesType $type = SeriesType::LINE;
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

    public function type(SeriesType $type): self
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
        return $this->type(SeriesType::LINE);
    }

    public function area(): self
    {
        return $this->type(SeriesType::AREA);
    }

    public function column(): self
    {
        return $this->type(SeriesType::COLUMN);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getType(): SeriesType
    {
        return $this->type;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function toArray(): array
    {
        $seriesData = [
            'name' => $this->name,
            'data' => array_values($this->data),
            'type' => $this->type->value,
        ];

        if ($this->color !== null) {
            $seriesData['color'] = $this->color;
        }

        return $seriesData;
    }
}
