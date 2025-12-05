<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Traits;

trait WithEvents
{
    protected string $events = '';

    public function setEvents(string $events): static
    {
        $this->events = $events;

        return $this;
    }

    public function getEvents(): string
    {
        if ($this->events === '') {
            return <<<JS
            {}
            JS;
        }

        return $this->events;
    }
}
