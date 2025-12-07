@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
    'decimals' => 3,
])

<div class="flex gap-3">
    @if($icon)
        <div>{!! $icon !!}</div>
    @endif

    @if($label)
        <h5>{!! $label !!}</h5>
    @endif
</div>

<div
    {{ $attributes->merge(['class' => 'chart']) }}
    x-data="donutChart({
        config: @js($config),
        events: {!! $events !!},
        decimals: {{ $decimals }}
    })"
></div>
