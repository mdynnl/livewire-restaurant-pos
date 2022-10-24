@props(['item'])
<div
    {{ $attributes }}
    class="flex gap-2 px-4 py-3 overflow-hidden transition-shadow bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer focus:outline-none outline-offset-4 outline-2 hover:shadow-md"
    tabindex="0"
    title="{{ $item->name }}"
>
    <div class="leading-7 truncate">
        {{ $item->name }}
    </div>
    <div
        class="px-2 ml-auto text-sm font-semibold leading-6 text-black border-2 border-green-500 rounded-lg w-min tabular-nums">
        {{ number_format($item->price, 2) }}
    </div>
    {{-- <div class="flex items-center hidden">
        @isset($item->category)
            <div class="px-3 text-xs leading-6 bg-gray-100 rounded-lg">{{ $item->category->name }}</div>
        @endisset
        <div
            class="px-2 ml-auto text-sm font-semibold leading-6 text-black border-2 border-green-500 rounded-lg w-min tabular-nums">
            {{ number_format($item->price, 2) }}
        </div>
    </div> --}}
</div>
