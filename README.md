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

```php
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Apexcharts\Support\SeriesItem;

LineChartMetric::make('Sales Data')
    ->series(SeriesItem::make('Revenue', $revenueData)->area())
    ->series(SeriesItem::make('Profit', $profitData)->line())
    ->series(SeriesItem::make('Costs', $costData)->column());
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
    ]);
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

## Theme Configuration

The `theme()` method allows you to configure chart appearance with color palettes and monochrome options:

```php
->theme(
    int|string|null $palette = null,      // Color palette (1-10) or palette name
    bool $monochromeEnabled = false,      // Enable monochrome colors
    bool $monochromeLight = false,        // Monochrome shade direction
    ?string $monochromeColor = null,      // Custom monochrome base color
    float $monochromeShadeIntensity = 0.65 // Monochrome shade intensity (0-1)
)
```

### Theme Examples

**Simple palette:**
```php
->theme(6)  // Use predefined color palette
```

**Monochrome with custom color:**
```php
->theme(
    monochromeEnabled: true,
    monochromeColor: '#FF6384',
    monochromeShadeIntensity: 0.5
)
```

## API Reference

### Common Methods

Available for all chart types:

- `->withoutWrapper()` - Remove box wrapper for custom layouts
- `->columnSpan(int $span)` - Number of grid columns (1-12)
- `->colors(array $colors)` - Override palette with custom colors
- `->theme(...)` - Configure theme with palette and options
- `->height(int $height)` - Chart height in pixels
- `->setEvents(string $js)` - JavaScript event handlers

### LineChartMetric

- `->series(array|SeriesItem $series)` - Add series
- `->withoutSortKeys()` - Preserve original key order

```php
SeriesItem::make(string $name, array $data)
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

## Grid Layout

Charts can be arranged in a responsive grid using MoonShine's `Grid` component and the `columnSpan()` method.

### Basic Grid Usage

```php
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\Apexcharts\Components\DonutChartMetric;
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Apexcharts\Components\RawChartMetric;

Grid::make([
    DonutChartMetric::make('Traffic Sources')
        ->values([
            'Direct' => 3250,
            'Organic' => 2100,
            'Social' => 1850,
            'Referral' => 1200,
        ])
        ->theme(2)
        ->columnSpan(4),

    DonutChartMetric::make('Sales by Category')
        ->values([
            'Electronics' => 45320,
            'Clothing' => 32150,
            'Food' => 28900,
            'Books' => 12300,
        ])
        ->theme(7)
        ->columnSpan(4),

    DonutChartMetric::make('User Activity')
        ->values([
            'Active' => 1250,
            'Inactive' => 320,
            'New' => 180,
            'Old' => 250,
        ])
        ->theme(1)
        ->columnSpan(4),
])
```

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/donut_chart_metric_column_span_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/donut_chart_metric_column_span.png">
    <img alt="Grid layout with donut charts" src="./art/donut_chart_metric_column_span.png">
</picture>

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/line_chart_metric_column_span_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/line_chart_metric_column_span.png">
    <img alt="Grid layout with line charts" src="./art/line_chart_metric_column_span.png">
</picture>

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
