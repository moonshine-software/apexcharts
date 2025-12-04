@props([
    'label' => '',
    'icon' => '',
    'labels' => [],
    'lines' => [],
    'colors' => [],
    'palette' => '',
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
    'height' => 300,
    'events' => '',
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
            :lines="$lines"
            :colors="$colors"
            :palette="$palette"
            :labels="$labels"
            :height="$height"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
