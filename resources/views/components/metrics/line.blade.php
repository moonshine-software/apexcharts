@props([
    'title' => '',
    'lines' => [],
    'colors' => [],
    'labels' => [],
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
                    },
                    @endforeach
                @endforeach
                ],
                colors: {{ json_encode($colors) }},
                labels: {{ json_encode($labels) }},
                chart: {
                    height: 300,
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
