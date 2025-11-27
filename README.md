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
| \>= v3.0  |      \>= v1.0.0      |         yes         |

## Installation

```shell
composer require moonshine/apexcharts
php artisan vendor:publish --tag=moonshine-apexcharts-assets
```

## Metric Donut Chart

The ***DonutChartMetric*** metric is designed for creating Donut charts.

### Make

You can create ***DonutChartMetric*** using the static `make()` method.

```php
make(Closure|string $label)
```

Method `values()` allows you to specify the relevance for a metric.

```php
values(array|Closure $values)
```

```php
use MoonShine\Apexcharts\Components\DonutChartMetric;

DonutChartMetric::make('Subscribers') 
    ->values(['CutCode' => 10000, 'Apple' => 9999]) 
```

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/donut_chart_metric_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/donut_chart_metric.png">
    <img alt="windows" src="./art/donut_chart_metric.png">
</picture>

### Colors

The `colors()` method allows you to specify colors for the metric.

```php
colors(array|Closure $values)
```

```php
DonutChartMetric::make('Subscribers')
    ->values(['CutCode' => 10000, 'Apple' => 9999])
    ->colors(['#ffcc00', '#00bb00'])
```

### Color Palettes

The `palette()` method allows you to use predefined ApexCharts color palettes.
This is especially useful for dark themes where default colors may appear too bright.

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

```php
DonutChartMetric::make('Sales by Category')
    ->values(['Electronics' => 15000, 'Clothing' => 8500, 'Books' => 3200])
    ->palette(9)

// Or use string format
DonutChartMetric::make('Sales by Category')
    ->values(['Electronics' => 15000, 'Clothing' => 8500, 'Books' => 3200])
    ->palette('palette5')
```

**Priority**: Custom colors (via `colors()`) have priority over palettes. If no colors or palette are specified, the default palette from configuration will be used.

**Configuration**: You can set the default palette by publishing the config:

```bash
php artisan vendor:publish --tag=moonshine-apexcharts-config
```

Then modify `config/apexcharts.php`:

```php
'default_palette' => 'palette5', // Default palette for all charts
```

### Decimal places

The `decimals()` method allows you to specify the maximum number of decimal places for the total value.

> [!NOTE]
> By default, up to three decimal places are displayed.

```php
DonutChartMetric::make('Subscribers')
    ->values(['CutCode' => 10000.12, 'Apple' => 9999.32])
    ->decimals(0) 
```

### Block width

Method `columnSpan()` allows you to set the block width in the *Grid* grid.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
)
```

- `$columnSpan` - relevant for desktop,
- `$adaptiveColumnSpan` - relevant for mobile version.

```php
use MoonShine\Apexcharts\Components\DonutChartMetric;
use MoonShine\UI\Components\Layout\Grid;

Grid::make([ 
    DonutChartMetric::make('Subscribers')
        ->values(['CutCode' => 10000, 'Apple' => 9999])
        ->columnSpan(6), 
    DonutChartMetric::make('Tasks')
        ->values(['New' => 234, 'Done' => 421])
        ->columnSpan(6) 
]) 
```

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/donut_chart_metric_column_span_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/donut_chart_metric_column_span.png">
    <img alt="windows" src="./art/donut_chart_metric_column_span.png">
</picture>

### Block height

Method `height()` allows you to set the block height in pixels.

```php
height(
    int|string $height
)
```

Default height is `350`

```php
DonutChartMetric::make('Subscribers')
    ->values(['CutCode' => 10000.12, 'Apple' => 9999.32])
    ->height(600) 
```

## Metric Line Chart

The ***LineChartMetric*** metric is designed to display line charts.

### Make

You can create a ***LineChartMetric** using the static `make()` method.

```php
make(Closure|string $label)
```

The `line()` method allows you to add a value line to the metric. You can add multiple lines to *ValueMetric*.

```php
line(
    array|Closure $line,
    string|array|Closure $color = '#7843E9',
    string|array|Closure $type = 'line',    
)
```

- `$line` - values for charting,
- `$color` - line color,
- `$type` - chart type (line, area, column)

```php
use MoonShine\Apexcharts\Components\LineChartMetric;

LineChartMetric::make('Orders') 
    ->line([
        'Profit' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray()
    ], type: fn() => 'area')
    ->line([
        'Avg' => Order::query()
            ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('avg','date')
            ->toArray()
    ], '#EC4176', 'line'); 
```

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/line_chart_metric_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/line_chart_metric.png">
    <img alt="windows" src="./art/line_chart_metric.png">
</picture>

You can define multiple lines through one `line()` method.

```php
LineChartMetric::make('Orders') 
    ->line([
        'Profit' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray(),
        'Avg' => Order::query()
            ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('avg','date')
            ->toArray()
    ],[
        'red', 'blue'
    ], [
        'area', 'line'
    ]);
```

### Sorting keys

By default, the LineChart chart has its keys sorted in ascending order.
This feature can be disabled using the `withoutSortKeys()` method.

```php
LineChartMetric::make('Orders')
    ->line([
        'Profit' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray()
    ])
    ->withoutSortKeys(), 
```

### Block width

Method `columnSpan()` allows you to set the block width in the *Grid* grid.

```php
columnSpan(
    int $columnSpan,
    int $adaptiveColumnSpan = 12
), 
```

- `$columnSpan` - relevant for desktop,
- `$adaptiveColumnSpan` - relevant for mobile version.

```php
use MoonShine\Apexcharts\Components\LineChartMetric;
use MoonShine\UI\Components\Layout\Grid;

### Color Palettes

Just like DonutChartMetric, LineChartMetric supports predefined color palettes through the `palette()` method. This helps resolve color contrast issues in dark themes.

```php
LineChartMetric::make('Sales Trend')
    ->line([
        'Revenue' => [12000, 15000, 18000, 14000, 20000],
        'Orders' => [120, 150, 180, 140, 200]
    ])
    ->palette(9) // Uses palette9 (earth tones) suitable for dark themes

// Or use string format
LineChartMetric::make('Sales Trend')
    ->line([
        'Revenue' => [12000, 15000, 18000, 14000, 20000],
        'Orders' => [120, 150, 180, 140, 200]
    ])
    ->palette('palette5') // Uses palette5 (balanced colors)
```

Grid::make([
    LineChartMetric::make('Articles')
        ->line([
            'Count' => [
                now()->subDays()->format('Y-m-d') =>
                    Article::whereDate(
                        'created_at',
                        now()->subDays()->format('Y-m-d')
                    )->count(),
                now()->format('Y-m-d') =>
                    Article::whereDate(
                        'created_at',
                        now()->subDays()->format('Y-m-d')
                    )->count()
            ]
        ])
        ->columnSpan(6), 
    LineChartMetric::make('Comments')
        ->line([
            'Count' => [
                now()->subDays()->format('Y-m-d') =>
                    Comment::whereDate(
                        'created_at',
                        now()->subDays()->format('Y-m-d')
                    )->count(),
                now()->format('Y-m-d') =>
                    Comment::whereDate(
                        'created_at',
                        now()->subDays()->format('Y-m-d')
                    )->count()
            ]
        ])
        ->columnSpan(6) 
])
```

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="./art/line_chart_metric_column_span_dark.png">
    <source media="(prefers-color-scheme: light)" srcset="./art/line_chart_metric_column_span.png">
    <img alt="windows" src="./art/line_chart_metric_column_span.png">
</picture>

### Block height

Method `height()` allows you to set the block height in pixels.

```php
height(
    int|string $height
)
```

Default height is `300`

```php
use MoonShine\Apexcharts\Components\LineChartMetric;

LineChartMetric::make('Orders') 
    ->line([
        'Avg' => Order::query()
            ->selectRaw('AVG(price) as avg, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('avg','date')
            ->toArray()
    ])
    ->height(600); 
```

## ApexChart Events

This method `setEvents()` allows you to use: [ApexCharts Events](https://apexcharts.com/docs/options/chart/events/).

It works with both `DonutChartMetric` and `LineChartMetric`.
For specific details and nuances, refer to [ApexCharts Events Documentation](https://apexcharts.com/docs/options/chart/events/).

```php
use MoonShine\Apexcharts\Components\LineChartMetric;

LineChartMetric::make('Orders')
    ->line([
        'Orders' => Order::query()
            ->selectRaw('SUM(price) as sum, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->pluck('sum','date')
            ->toArray()
    ], type: 'bar')
    ->withoutSortKeys()
    ->setEvents(<<<JS
    {
        dataPointSelection: function(event, chartContext, config) {
            var pointIndex = config.dataPointIndex;
            location.href = '/admin/page/dashboard/?point=' + (pointIndex + 1);
        }
    }
    JS),
```
