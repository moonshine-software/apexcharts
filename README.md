# ApexCharts for [MoonShine](https://moonshine-laravel.com) Laravel admin panel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/moonshine/apexcharts.svg?style=flat-square)](https://packagist.org/packages/moonshine/apexcharts)
[![Total Downloads](https://img.shields.io/packagist/dt/moonshine/apexcharts.svg?style=flat-square)](https://packagist.org/packages/moonshine/apexcharts)

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/apexcharts_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/apexcharts.png">
    <img alt="ApexCharts for MoonShine" src="./art/apexcharts.png">
</picture>

> [!NOTE]
> This package adds [ApexCharts.js](https://apexcharts.com/) components to the [MoonShine](https://moonshine-laravel.com/) Laravel admin panel.

## Compatibility

| MoonShine | Moonshine ApexCharts | Currently supported |
|:---------:|:--------------------:|:-------------------:|
| \>= v3.0  |      \>= v1.0.0      |         no          |
| \>= v3.0  |      \>= v2.0.0      |         yes         |

## Installation

Install the package via Composer:

```bash
composer require moonshine/apexcharts
```

Publish the assets:

```bash
php artisan vendor:publish --tag=moonshine-apexcharts-assets --force
```

Optional: Publish the configuration file to customize default settings:

```bash
php artisan vendor:publish --tag=moonshine-apexcharts-config
```

## Available Chart Types

- **Line Chart** - Linear, area, and column charts for time-series data with full typing support
- **Donut Chart** - Circular charts for categorical data
- **Raw Chart** - Direct access to ApexCharts configuration for maximum flexibility

## Quick Start

### Line Chart

#### Typed Approach (Recommended)

```php
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Apexcharts\Support\Line;

LineChartMetric::make('Sales Data')
    ->addLine(Line::make('Revenue', $revenueData)->area())
    ->addLine(Line::make('Profit', $profitData)->line())
    ->addLine(Line::make('Costs', $costData)->column())
    ->palette(6);
```

#### Array Approach

```php
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Apexcharts\Support\ChartType;

LineChartMetric::make('Sales Data')
    ->line([
        'Revenue' => $revenueData,
        'Profit' => $profitData,
        'Costs' => $costData,
    ], [ChartType::AREA, ChartType::LINE, ChartType::COLUMN]);
```

### Donut Chart

```php
use MoonShine\Apexcharts\Components\DonutChartMetric;

DonutChartMetric::make('Traffic Sources')
    ->values([
        'Direct' => 3250,
        'Organic' => 2100,
        'Social' => 1850,
        'Referral' => 1200,
    ])
    ->palette(2);
```

### Raw Chart

For custom chart types or advanced configurations:

```php
use MoonShine\Apexcharts\Components\RawChartMetric;

RawChartMetric::make('Interactive Radar Chart')
    ->config([
        'chart' => [
            'type' => 'radar',
            'height' => 350,
        ],
        'series' => [
            [
                'name' => 'Current Year',
                'data' => [20, 90, 45, 75, 60],
            ],
        ],
        'xaxis' => [
            'categories' => ['Q1', 'Q2', 'Q3', 'Q4', 'Q5'],
        ],
    ])
    ->setEvents(<<<'JS'
        {
            click: (chartContext, options) => {
                console.log('Chart clicked:', options);
            }
        }
    JS);
```

## API Reference

### Common Methods

Available for all chart types:

| Method | Type | Description |
|--------|------|-------------|
| `->colors(array $colors)` | array | Override palette with custom colors |
| `->columnSpan(int $span)` | int | Number of grid columns (1-12) |
| `->height(int $height)` | int | Chart height in pixels |
| `->palette(int|string $palette)` | int/string | Color palette (1-10 or palette name) |
| `->setEvents(string $js)` | string | JavaScript event handlers |
| `->withoutWrapper()` | - | Remove box wrapper for custom layouts |

### Color Palettes

| Palette | Preview | Colors |
|---------|---------|--------|
| `palette1` | Vibrant | `#008FFB`, `#00E396`, `#FEB019`, `#FF4560`, `#775DD0` |
| `palette2` | Material | `#3f51b5`, `#03a9f4`, `#4caf50`, `#f9ce1d`, `#FF9800` |
| `palette3` | Muted | `#33b2df`, `#546E7A`, `#d4526e`, `#13d8aa`, `#A5978B` |
| `palette4` | Pastel | `#4ecdc4`, `#c7f464`, `#81D4FA`, `#546E7A`, `#fd6a6a` |
| `palette5` | Balanced | `#2b908f`, `#f9a3a4`, `#90ee7e`, `#fa4443`, `#69d2e7` |
| `palette6` | Professional | `#449DD1`, `#F86624`, `#EA3546`, `#662E9B`, `#C5D86D` |
| `palette7` | Warm | `#D7263D`, `#1B998B`, `#2E294E`, `#F46036`, `#E2C044` |
| `palette8` | Purple/Orange | `#662E9B`, `#F86624`, `#F9C80E`, `#EA3546`, `#43BCCD` |
| `palette9` | Earth Tones | `#5C4742`, `#A5978B`, `#8D5B4C`, `#5A2A27`, `#C4BBAF` |
| `palette10` | Blue/Purple | `#A300D6`, `#7D02EB`, `#5653FE`, `#2983FF`, `#00B1F2` |

### LineChartMetric

#### Additional Methods

| Method | Type | Description |
|--------|------|-------------|
| `->addLine(Line $line)` | Line | Add a single line |
| `->addLines(array $lines)` | Line[] | Add multiple lines |
| `->line(array $data, array $types)` | array | Legacy array approach |
| `->withoutSortKeys()` | - | Preserve original key order |

#### Line Helper

```php
Line::make(string $name, array $data)
    ->line()                     // Line chart type
    ->area()                     // Area chart type
    ->column()                   // Column chart type
    ->color('#FF5722')           // Custom color
    ->name('New Name')           // Change display name
    ->data([...])                // Update data
```

### DonutChartMetric

#### Additional Methods

| Method | Type | Description |
|--------|------|-------------|
| `->values(array $values)` | array | Chart data (key => value) |
| `->decimals(int $decimals)` | int | Decimal places (0-100) |

### RawChartMetric

#### Additional Methods

| Method | Type | Description |
|--------|------|-------------|
| `->config(array $config)` | array | Full ApexCharts configuration |

## Events

Add interactivity with JavaScript events:

```php
RawChartMetric::make('Interactive Chart')
    ->setEvents(<<<'JS'
        {
            dataPointSelection: (event, chartContext, config) => {
                console.log('Selected:', config.w.config.labels[config.dataPointIndex]);
            },
            click: (chartContext, options) => {
                // Handle chart click
            }
        }
    JS);
```

## Configuration

Create your own `config/moonshine_apexcharts.php` to customize defaults:

```php
<?php

return [
    'default_palette' => 'palette6',
];
```

Or use environment variable:

```env
APEXCHARTS_DEFAULT_PALETTE=palette6
```

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
