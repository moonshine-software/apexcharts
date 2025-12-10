<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default ApexCharts Palette
    |--------------------------------------------------------------------------
    |
    | This option controls the default color palette used for ApexCharts
    | when no explicit colors or palette is specified. Available options:
    | 1 - 10
    |
    | 1: #008FFB, #00E396, #FEB019, #FF4560, #775DD0 (vibrant colors)
    | 2: #3f51b5, #03a9f4, #4caf50, #f9ce1d, #FF9800 (material colors)
    | 3: #33b2df, #546E7A, #d4526e, #13d8aa, #A5978B (muted colors)
    | 4: #4ecdc4, #c7f464, #81D4FA, #546E7A, #fd6a6a (pastel colors)
    | 5: #2b908f, #f9a3a4, #90ee7e, #fa4443, #69d2e7 (balanced colors)
    | 6: #449DD1, #F86624, #EA3546, #662E9B, #C5D86D (professional colors)
    | 7: #D7263D, #1B998B, #2E294E, #F46036, #E2C044 (warm colors)
    | 8: #662E9B, #F86624, #F9C80E, #EA3546, #43BCCD (purple/orange theme)
    | 9: #5C4742, #A5978B, #8D5B4C, #5A2A27, #C4BBAF (earth tones)
    | 10: #A300D6, #7D02EB, #5653FE, #2983FF, #00B1F2 (blue/purple theme)
    */

    'default_palette' => env('APEXCHARTS_DEFAULT_PALETTE', 6),

    /*
    |--------------------------------------------------------------------------
    | Default Chart Heights
    |--------------------------------------------------------------------------
    |
    | Default heights for different chart types when no explicit height
    | is set via the height() method. Can be overridden per chart type.
    | Values are in pixels.
    |
    */

    'default_height' => [
        'line' => env('APEXCHARTS_DEFAULT_HEIGHT_LINE', 333),
        'donut' => env('APEXCHARTS_DEFAULT_HEIGHT_DONUT', 350),
        'raw' => env('APEXCHARTS_DEFAULT_HEIGHT_RAW', 350),
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Default Height
    |--------------------------------------------------------------------------
    |
    | Fallback height when specific chart type height is not configured.
    | Can be overridden via APEXCHARTS_DEFAULT_HEIGHT env variable.
    | Value is in pixels.
    |
    */

    'fallback_height' => env('APEXCHARTS_DEFAULT_HEIGHT', 350),
];
