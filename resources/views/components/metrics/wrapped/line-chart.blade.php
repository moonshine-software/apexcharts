@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
])
<x-moonshine::layout.column
    :colSpan="$columnSpanValue"
    :adaptiveColSpan="$adaptiveColumnSpanValue"
>
    <x-moonshine::layout.box>
        <x-moonshine-apexcharts::metrics.line
            :attributes="$attributes"
            :label="$label"
            :icon="$icon"
            :config="$config"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
