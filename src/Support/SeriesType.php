<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Support;

enum SeriesType: string
{
    case LINE = 'line';
    case AREA = 'area';
    case COLUMN = 'column';
}
