@props([
    'title' => '',
    'lines' => [],
    'colors' => [],
    'labels' => [],
    'types' => [],
])
<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="charts({
                series: [
                @foreach($lines as $lineKey => $line)
                    @foreach($line as $label => $values)
                    {
                        name: '{{ $label }}',
                        data: {{ json_encode(array_values($values)) }},
                        type: '{{ $types[$lineKey][$label] }}',
                    },
                    @endforeach
                @endforeach
                ],
                colors: {{ json_encode($colors) }},
                labels: {{ json_encode($labels) }},
                chart: {
                    height: 300,
                    type: 'line',
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
