<?php

declare(strict_types=1);

namespace MoonShine\Apexcharts\Support;

enum ChartType: string
{
    case LINE = 'line';
    case AREA = 'area';
    case COLUMN = 'column';
}
