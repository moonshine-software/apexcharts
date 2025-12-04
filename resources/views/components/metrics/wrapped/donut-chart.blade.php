@props([
    'label' => '',
    'icon' => '',
    'labels' => [],
    'values' => [],
    'colors' => [],
    'palette' => '',
    'decimals' => 3,
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
    'height' => 350,
    'events' => '',
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
            :values="$values"
            :labels="$labels"
            :colors="$colors"
            :palette="$palette"
            :decimals="$decimals"
            :height="$height"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
