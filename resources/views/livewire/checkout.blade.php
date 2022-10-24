<div class="flex flex-col h-full mx-auto overflow-auto">
    <div class="sticky top-0 flex items-center justify-between h-12 px-4 py-2 bg-white border-b">
        <div class="">Order - {{ $order->id }}</div>
        <div class="flex gap-2">
            @foreach ($order->tables as $table)
                <div class="px-2 border rounded-md cursor-pointer hover:bg-white">{{ $table->name }}</div>
            @endforeach
        </div>
    </div>

    @foreach ($order->table_orders as $table_order)
        <div class="flex flex-col flex-1 border-gray-400">
            <div class="flex items-center justify-between gap-1 px-6 py-3 bg-gray-50">
                <div>{{ $table_order->table->name }}</div>
                <div class="text-xs text-gray-600">
                    {{ $seats = $table_order->seats }}
                    {{ Str::plural('seat', $seats) }}
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
                        <div class="grid grid-cols-[repeat(3,1fr)] tabular-nums">
                            <div class="leading-7 truncate">{{ $name }}</div>
                            <div class="flex items-center ml-auto text-sm font-medium">
                                {{ $qty }}
                                &times;
                                {{ number_format($price, 2) }}

                            </div>
                            <div class="ml-auto">
                                {{ number_format($subtotal, 2) }}
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between gap-5 p-4 mt-auto font-bold bg-gray-100 tabular-nums">
                @if ($order->table_orders->count() > 1)
                    Subtotal
                @else
                    Total
                @endif
                <span>{{ number_format($table_order->total(), 2) }}</span>
            </div>

        </div>
    @endforeach
    <div class="sticky bottom-0 mt-auto">
        @if ($order->table_orders->count() > 1)
            <div class="flex justify-between gap-5 p-4 mt-1 text-xl font-bold bg-gray-200 tabular-nums">
                Total
                <span>{{ number_format($order->total(), 2) }}</span>
            </div>
        @endif

        @if ($order->status->value == 'paid')
        @else
            <div class="flex items-center gap-5 p-4 bg-white">
                <button
                    class="px-4 py-1 border border-gray-300 rounded-md hover:bg-gray-100"
                    wire:click='confirm'
                >
                    Confirm checkout

                </button>
        @endif
    </div>
</div>

</div>
