@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
    'events' => '',
])
<x-moonshine::layout.column
    :colSpan="$columnSpanValue"
    :adaptiveColSpan="$adaptiveColumnSpanValue"
>
    <x-moonshine::layout.box>
        <x-moonshine-apexcharts::metrics.raw-data-chart
            :attributes="$attributes"
            :label="$label"
            :icon="$icon"
            :config="$config"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
