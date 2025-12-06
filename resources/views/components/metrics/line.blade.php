@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '',
])

@if($icon)
<div>{!! $icon !!}</div>
@endif

<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="charts({
        config: @js($config),
        events: {!! $events !!}
    })"
></div>
