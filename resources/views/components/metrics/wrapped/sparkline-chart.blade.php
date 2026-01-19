@props([
    'label' => '',
    'icon' => '',
    'config' => [],
    'events' => '{}',
    'columnSpanValue' => 12,
    'adaptiveColumnSpanValue' => 12,
    'formattedValue' => null,
    'formattedChange' => null,
    'isPositiveChange' => true,
    'changeText' => null,
])
<x-moonshine::layout.column
    :colSpan="$columnSpanValue"
    :adaptiveColSpan="$adaptiveColumnSpanValue"
>
    <x-moonshine::layout.box style="padding: 0">
        <x-moonshine-apexcharts::metrics.sparkline
            :attributes="$attributes"
            :label="$label"
            :icon="$icon"
            :config="$config"
            :events="$events"
            :formattedValue="$formattedValue"
            :formattedChange="$formattedChange"
            :isPositiveChange="$isPositiveChange"
            :changeText="$changeText"
        />
    </x-moonshine::layout.box>
</x-moonshine::layout.column>
