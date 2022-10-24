@props(['data' => null])
<div
    {{ $attributes->except('wire:model') }}
    x-data="{ data: @js($data) }"
>
    <pre x-text="JSON.stringify(data, null, 2)"></pre>
</div>
