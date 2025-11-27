<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default ApexCharts Palette
    |--------------------------------------------------------------------------
    |
    | This option controls the default color palette used for ApexCharts
    | when no explicit colors or palette is specified. Available options:
    | "palette1" - "palette10"
    |
    | palette1: #008FFB, #00E396, #FEB019, #FF4560, #775DD0 (vibrant colors)
    | palette2: #3f51b5, #03a9f4, #4caf50, #f9ce1d, #FF9800 (material colors)
    | palette3: #33b2df, #546E7A, #d4526e, #13d8aa, #A5978B (muted colors)
    | palette4: #4ecdc4, #c7f464, #81D4FA, #546E7A, #fd6a6a (pastel colors)
    | palette5: #2b908f, #f9a3a4, #90ee7e, #fa4443, #69d2e7 (balanced colors)
    | palette6: #449DD1, #F86624, #EA3546, #662E9B, #C5D86D (professional colors)
    | palette7: #D7263D, #1B998B, #2E294E, #F46036, #E2C044 (warm colors)
    | palette8: #662E9B, #F86624, #F9C80E, #EA3546, #43BCCD (purple/orange theme)
    | palette9: #5C4742, #A5978B, #8D5B4C, #5A2A27, #C4BBAF (earth tones)
    | palette10: #A300D6, #7D02EB, #5653FE, #2983FF, #00B1F2 (blue/purple theme)
    |
    */

    'default_palette' => env('APEXCHARTS_DEFAULT_PALETTE', 'palette6'),
];
