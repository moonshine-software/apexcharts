@props([
    'title' => '',
    'lines' => [],
    'colors' => [],
    'palette' => '',
    'labels' => [],
    'types' => [],
    'height' => 300,
    'events' => '',
])
<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="charts({
                series: [
                @foreach($lines as $line)
                    @foreach($line as $label => $values)
                    {
                        name: '{{ $label }}',
                        data: {{ json_encode(array_values($values)) }},
                        type: '{{ $types[$loop->parent->index][$label] ?? $types[$loop->parent->index][0] ?? "line" }}',
                    },
                    @endforeach
                @endforeach
                ],
                @if(!empty($colors))
                colors: {{ json_encode($colors) }},
                @elseif(!empty($palette))
                theme: {
                    palette: '{{ $palette }}'
                },
                @else
                theme: {
                    palette: '{{ config('moonshine_apexcharts.default_palette', 'palette5') }}'
                },
                @endif
                labels: {{ json_encode($labels) }},
                chart: {
                    height: {{ $height }},
                    type: 'line',
                    events: {!! $events !!}
                },
                yaxis: {
                    title: {
                        text: '{{ $title }}',
                        style: {
                            fontWeight: 400,
                        },
                    },
                },
            })"
></div>
