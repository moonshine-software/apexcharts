@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
    'decimals' => 3,
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
])
<x-moonshine::layout.column
    :colSpan="$columnSpanValue"
    :adaptiveColSpan="$adaptiveColumnSpanValue"
>
    <x-moonshine::layout.box>
        <x-moonshine-apexcharts::metrics.donut
            :attributes="$attributes"
            :label="$label"
            :icon="$icon"
            :config="$config"
            :events="$events"
            :decimals="$decimals"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
