@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
    'formattedValue' => null,
    'formattedChange' => null,
    'isPositiveChange' => true,
    'changeText' => null,
])

<div class="flex flex-col gap-1" style="padding: var(--_box-padding-x) var(--_box-padding-y) 5px var(--_box-padding-y)">
    <div class="flex gap-3 items-center">
        @if($icon)
            <div>{!! $icon !!}</div>
        @endif

        @if($label)
            <h5>{!! $label !!}</h5>
        @endif
    </div>

    @if($formattedValue)
        <div class="text-2xl font-semibold">
            {{ $formattedValue }}
        </div>
    @endif

    @if($formattedChange)
        <div
            class="flex items-center gap-1 text-sm"
            style="color: var({{ $isPositiveChange ? '--color-success-text' : '--color-error-text' }})"
        >
            <span>{{ $formattedChange }}</span>
            @if($changeText)
                <span>{{ $changeText }}</span>
            @endif
            @if($isPositiveChange)
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.577 4.878a.75.75 0 0 1 .919-.53l4.78 1.281a.75.75 0 0 1 .531.919l-1.281 4.78a.75.75 0 0 1-1.449-.387l.81-3.022a19.407 19.407 0 0 0-5.594 5.203.75.75 0 0 1-1.139.093L7 10.06l-4.72 4.72a.75.75 0 0 1-1.06-1.061l5.25-5.25a.75.75 0 0 1 1.06 0l3.074 3.073a20.923 20.923 0 0 1 5.545-4.931l-3.042-.815a.75.75 0 0 1-.53-.919Z" clip-rule="evenodd"></path>
                </svg>
            @else
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.22 5.222a.75.75 0 0 1 1.06 0L7 9.942l3.768-3.769a.75.75 0 0 1 1.113.058 20.908 20.908 0 0 1 3.813 7.254l1.574-2.727a.75.75 0 0 1 1.3.75l-2.475 4.286a.75.75 0 0 1-1.025.275l-4.287-2.475a.75.75 0 0 1 .75-1.3l2.71 1.565a19.422 19.422 0 0 0-3.013-6.024L7.53 11.533a.75.75 0 0 1-1.06 0l-5.25-5.25a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"></path>
                </svg>
            @endif
        </div>
    @endif
</div>

<div
    {{ $attributes->merge(['class' => 'chart']) }}
    style="margin-top: 0"
    x-data="sparklineChart({
        config: @js($config),
        events: {!! $events !!}
    })"
></div>
