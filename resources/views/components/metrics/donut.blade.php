@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
    'decimals' => 3,
])

@if($icon)
<div>{!! $icon !!}</div>
@endif

<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="donutChart({
        config: @js($config),
        events: {!! $events !!},
        decimals: {{ $decimals }}
    })"
></div>
