@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
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
    x-data="charts({
        config: @js($config),
        events: {!! $events !!}
    })"
></div>
