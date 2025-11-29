@props([
    'label' => '',
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
            :lines="$lines"
            :colors="$colors"
            :palette="$palette"
            :labels="$labels"
            :label="$label"
            :height="$height"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>


