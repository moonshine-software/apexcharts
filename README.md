# ApexCharts for [MoonShine Laravel admin panel](https://moonshine-laravel.com)

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/apexcharts_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/apexcharts.png">
    <img alt="windows" src="./art/apexcharts.png">
</picture>

> [!NOTE]
> The package is based on the [ApexCharts](https://apexcharts.com/) library.

---

## Compatibility

| MoonShine | Moonshine ApexCharts | Currently supported |
|:---------:|:--------------------:|:-------------------:|
| \>= v3.0  |      \>= v1.0.0      |         no          |
| \>= v3.0  |      \>= v2.0.0      |         yes         |

## Installation

```shell
composer require moonshine/apexcharts
```

```shell
php artisan vendor:publish --tag=moonshine-apexcharts-assets --force
```

Optional: to customize default settings

```shell
php artisan vendor:publish --tag=moonshine-apexcharts-config
```

## Available Charts

- **Line Chart** - Linear, area, and column charts for time-series data with full typing support,
- **Donut Chart** - Circular charts for categorical data.

## Usage

### Line Chart

#### Typed Approach (Recommended)

```php
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Apexcharts\Support\Line;
use MoonShine\Apexcharts\Support\ChartType;

LineChartMetric::make('Sales')
    ->addLine(Line::make('Revenue', $data)->area())
    ->addLine(Line::make('Profit', $data)->line())
    ->addLine(Line::make('Costs', $data)->column());
```

#### Legacy Array Approach

```php
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\Apexcharts\Support\ChartType;

LineChartMetric::make('Sales')
    ->line([
        'Revenue' => $data,
        'Profit' => $data,
        'Costs' => $data,
    ], [ChartType::AREA, ChartType::LINE, ChartType::COLUMN]);
```

### Donut Chart

```php
use MoonShine\Apexcharts\Components\DonutChartMetric;

DonutChartMetric::make('Subscribers')
    ->values([
        'CutCode' => 10000,
        'Apple' => 9999,
    ]);
```

## Methods

### Common

```php
->colors(array)         // Custom colors
->columnSpan(int)       // Grid columns
->height(int)           // Chart height
->palette(int|string)   // Color palette (1-10 or palette name)
->setEvents(string)     // Custom JavaScript events
->withoutWrapper()      // Without box wrapper
```

#### Color Palettes

Available palettes:
- `palette1`: Vibrant colors (#008FFB, #00E396, #FEB019, #FF4560, #775DD0)
- `palette2`: Material colors (#3f51b5, #03a9f4, #4caf50, #f9ce1d, #FF9800)
- `palette3`: Muted colors (#33b2df, #546E7A, #d4526e, #13d8aa, #A5978B)
- `palette4`: Pastel colors (#4ecdc4, #c7f464, #81D4FA, #546E7A, #fd6a6a)
- `palette5`: Balanced colors (#2b908f, #f9a3a4, #90ee7e, #fa4443, #69d2e7)
- `palette6`: Professional colors (#449DD1, #F86624, #EA3546, #662E9B, #C5D86D)
- `palette7`: Warm colors (#D7263D, #1B998B, #2E294E, #F46036, #E2C044)
- `palette8`: Purple/orange theme (#662E9B, #F86624, #F9C80E, #EA3546, #43BCCD)
- `palette9`: Earth tones (#5C4742, #A5978B, #8D5B4C, #5A2A27, #C4BBAF)
- `palette10`: Blue/purple theme (#A300D6, #7D02EB, #5653FE, #2983FF, #00B1F2)

### LineChartMetric

```php
->addLine(Line $line)           // Add a Line object
->addLines(array $lines)        // Add multiple Line objects
->line(array $data, $colors, $types)  // Legacy array approach
->withoutSortKeys()             // Preserve key order
->withoutWrapper()              // Without box wrapper
```

#### Line Methods

```php
Line::make('Name', $data)
    ->line()                     // Line chart type
    ->area()                     // Area chart type
    ->column()                   // Column chart type
    ->color('#hex')              // Custom color
    ->name('New Name')           // Change line name
    ->data([...])                // Change line data
```

### DonutChartMetric

```php
->values(array)                  // Set chart values
->decimals(int)                  // Decimal places (0-100)
->withoutWrapper()               // Without box wrapper
```
