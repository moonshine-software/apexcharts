@props([
    'title' => '',
    'lines' => [],
    'colors' => [],
    'labels' => [],
    'types' => [],
    'height' => 300,
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
                        type: '{{ $types[$loop->parent->index % count($types)][$label] ?? "line" }}',
                    },
                    @endforeach
                @endforeach
                ],
                colors: {{ json_encode($colors) }},
                labels: {{ json_encode($labels) }},
                chart: {
                    height: {{ $height }},
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
