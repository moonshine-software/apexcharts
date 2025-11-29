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
                    @php
                        // $line is now a Line object
                        $lineName = $line->getName();
                        $lineData = array_values($line->getData());
                        $lineType = $line->getType()->value;
                        $lineColor = $line->getColor();
                    @endphp
                    {
                        name: '{{ $lineName }}',
                        data: {{ json_encode($lineData) }},
                        type: '{{ $lineType }}',
                        @if($lineColor)
                        color: '{{ $lineColor }}',
                        @endif
                    },
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
                        text: '{{ $label }}',
                        style: {
                            fontWeight: 400,
                        },
                    },
                },
            })"
></div>
