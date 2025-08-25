@props([
    'label' => '',
    'labels' => [],
    'lines' => [],
    'colors' => [],
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
    'types' => [],
    'height' => 300,
    'events' => '',
])
<x-moonshine::layout.column
    :colSpan="$columnSpanValue"
    :adaptiveColSpan="$adaptiveColumnSpanValue"
>
    <x-moonshine::layout.box class="grow">
        <x-moonshine-apexcharts::metrics.line
            :attributes="$attributes"
            :lines="$lines"
            :colors="$colors"
            :labels="$labels"
            :title="$label"
            :types="$types"
            :height="$height"
            :events="$events"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>


