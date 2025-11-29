@props([
    'label' => '',
    'lines' => [],
    'colors' => [],
    'palette' => '',
    'labels' => [],
    'height' => 300,
    'events' => '',
])
@php
    /**
     * @var MoonShine\Apexcharts\Support\Line $line
     */
@endphp
<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="charts({
                series: [
                @foreach($lines as $line)
                    {
                        name: '{{ $line->getName() }}',
                        data: {{ json_encode(array_values($line->getData())) }},
                        type: '{{ $line->getType()->value }}',
                        @if($line->getColor())
                        color: '{{ $line->getColor() }}',
                        @endif
                    },
                @endforeach
                ],
                @if(!empty($colors))
                colors: {{ json_encode($colors) }},
                @else
                theme: {
                    palette: '{{ $palette }}'
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
                        text: '{{ $label }}',
                        style: {
                            fontWeight: 400,
                        },
                    },
                },
            })"
></div>
