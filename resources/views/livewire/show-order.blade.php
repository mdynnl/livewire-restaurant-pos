<div class="grid grid-cols-[20em_1fr] overflow-auto h-full">

    <div class="flex flex-col min-h-full border-r-2 border-gray-400">
        <div class="flex justify-between px-4 py-2">
            <div class="">Order - {{ $order->id }}</div>
            <div class="flex gap-2">
                @foreach ($order->tables as $table)
                    <a
                        {{-- wire:click="$set('table_id', {{ $table->id }})" --}}
                        @class([
                            'px-2 border rounded-md',
                            $table->is($this->table)
                                ? 'bg-green-300 text-white'
                                : 'cursor-pointer hover:bg-white',
                            'pointer-events-none' => $this->table->is($table),
                        ])
                        data-turbo-action="replace"
                        href="{{ route('order', ['order' => $order, 'table' => $table]) }}"
                    >{{ $table->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="relative flex items-center justify-between gap-1 px-6 py-3 bg-gray-50">

            <div class="leading-7 truncate">{{ $this->table->name }}</div>

            <div class="flex items-center gap-2">
                <button
                    @class([
                        'border-gray-300 rounded-md border px-2',
                        ($disabled = ($seats = $table_order->seats) == 1)
                            ? 'bg-gray-100'
                            : 'bg-white hover:bg-gray-100',
                    ])
                    @disabled($disabled)
                    wire:click='updateSeat(-1)'
                    wire:loading.attr="disabled"
                >
                    &minus;
                </button>
                <div class="text-xs text-gray-600">
                    {{ $seats }}
                    {{ Str::plural('seat', $seats) }}
                </div>
                <button
                    class="px-2 bg-white border border-gray-300 rounded-md hover:bg-gray-100"
                    wire:click='updateSeat'
                >&plus;</button>
            </div>
        </div>
        <div class="flex-1 overflow-auto">
            @foreach ($table_order->order_items as $order_item)
                @php
                    [
                        'item' => [
                            'id' => $itemId,
                            'name' => $name,
                            'price' => $price,
                        ],
                        'id' => $id,
                        'qty' => $qty,
                    ] = $order_item;
                    $subtotal = $price * $qty;
                @endphp
                <div
                    class="flex flex-col gap-2 px-4 py-3 overflow-hidden transition-shadow bg-white border-b border-gray-200">
                    <div class="flex justify-between leading-7 truncate">
                        <div class="leading-7 truncate">{{ $name }}</div>

                        <div class="flex gap-1">
                            <button
                                {{-- wire:loading.attr="disabled" --}}
                                @class(['border-gray-300 rounded-md border  px-5  hover:bg-gray-100'])
                                wire:click='updateQty({{ $id }}, -1)'
                            >
                                &minus;
                            </button>
                            <button
                                class="px-5 border border-gray-300 rounded-md hover:bg-gray-100"
                                wire:click='updateQty({{ $id }})'
                            >&plus;</button>
                        </div>
                    </div>
                    <div class="flex items-center text-sm font-medium tabular-nums">
                        {{ $qty }}
                        &times;
                        {{ number_format($price, 2) }}

                        <div class="ml-auto">
                            {{ number_format($subtotal, 2) }}
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-between gap-5 p-4 text-lg font-bold bg-gray-200 tabular-nums">
            @if ($order->table_orders->count() > 1)
                Subtotal
            @else
                Total
            @endif
            <span>{{ number_format($table_order->total(), 2) }}</span>
        </div>

        @if ($order->table_orders->count() > 1)
            <div class="flex justify-between gap-5 p-4 mt-1 text-xl font-bold bg-gray-200 tabular-nums">
                Total
                <span>{{ number_format($order->total(), 2) }}</span>
            </div>
        @endif

        <div class="flex gap-5 p-4">
            <a
                class="px-4 py-1 border border-gray-300 rounded-md hover:bg-gray-100"
                href="{{ route('split', $order) }}"
            >
                Split
            </a href="">
            <a
                class="px-4 py-1 border border-gray-300 rounded-md hover:bg-gray-100"
                href="{{ route('merge', $order) }}"
            >
                Merge
            </a>
            <a
                class="px-4 py-1 border border-gray-300 rounded-md hover:bg-gray-100"
                href="{{ route('checkout', $order) }}"
            >
                Checkout

            </a>
        </div>
    </div>

    <livewire:show-items />

</div>
