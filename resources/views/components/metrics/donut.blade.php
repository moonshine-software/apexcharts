@props([
    'title' => '',
    'values' => [],
    'labels' => [],
    'colors' => [],
    'palette' => '',
    'decimals' => 3,
    'height' => 350,
    'events' => '',
])

<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="charts({
        series: {{ json_encode($values) }},
        labels: {{ json_encode($labels) }},
        chart: {
            height: {{ $height }},
            type: 'donut',
            background: 'transparent',
            foreColor: '#6a778f',
            events: {!! $events !!}
        },
        @if(!empty($colors))
        colors: {{ json_encode($colors) }},
        @elseif(!empty($palette))
        theme: {
            mode: 'dark',
            palette: '{{ $palette }}'
        },
        @else
        theme: {
            mode: 'dark',
            palette: '{{ config('moonshine_apexcharts.default_palette', 'palette5') }}'
        },
        @endif
        tooltip: {
            y: {
                formatter: function (val) {
                    return `${val}`
                },
                title: {
                    formatter: function (seriesName) {
                        return `${seriesName}:`
                    },
                },
            },
            theme: 'dark'
        },
        stroke: {
            colors: ['transparent'],
        },
        plotOptions: {
            pie: {
                expandOnClick: false,
                donut: {
                    labels: {
                        show: true,
                        total: {
                            label: '{{ $title }}',
                            showAlways: false,
                            show: true,
                            formatter: function (w) {
                            return Number(w.globals.seriesTotals.reduce((a, b) => {
                              return a + b
                            }, 0).toFixed({{ $decimals }}))
                          }
                        }
                    }
                }
            },
        },
        legend: {
            position: 'bottom',
            offsetY: 10,
            itemMargin: {
                horizontal: 6,
                vertical: 6,
            },
        },
    })"
></div>
