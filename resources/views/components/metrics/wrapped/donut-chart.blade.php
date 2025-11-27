@props([
    'label' => '',
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
    <x-moonshine::layout.box class="grow">
        <x-moonshine-apexcharts::metrics.donut
            :attributes="$attributes"
            :values="$values"
            :labels="$labels"
            :colors="$colors"
            :palette="$palette"
            :decimals="$decimals"
            :title="$label"
            :height="$height"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
