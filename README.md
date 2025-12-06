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

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/line_chart_metric_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/line_chart_metric.png">
    <img alt="windows" src="./art/line_chart_metric.png">
</picture>

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

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/donut_chart_metric_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/donut_chart_metric.png">
    <img alt="windows" src="./art/donut_chart_metric.png">
</picture>

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

- `->withoutWrapper()` - Remove box wrapper for custom layouts
- `->columnSpan(int $span)` - Number of grid columns (1-12)
- `->colors(array $colors)` - Override palette with custom colors
- `->palette(int|string $palette)` - Color palette (1-10 or palette name)
- `->height(int $height)` - Chart height in pixels
- `->setEvents(string $js)` - JavaScript event handlers

### LineChartMetric

- `->addLine(Line $line)` - Add a single line
- `->addLines(array $lines)` - Add multiple lines
- `->line(array $data, array $types)` - Legacy array approach
- `->withoutSortKeys()` - Preserve original key order

```php
Line::make(string $name, array $data)
    ->line()                // Line chart type
    ->area()                // Area chart type
    ->column()              // Column chart type
    ->color('#FF5722')      // Custom color
    ->name('New Name')      // Change display name
    ->data([...])           // Update data
```

### DonutChartMetric

- `->values(array $values)` - Chart data (key => value)
- `->decimals(int $decimals)` - Decimal places (0-100)

### RawChartMetric

- `->config(array $config)` - Full ApexCharts configuration

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

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
