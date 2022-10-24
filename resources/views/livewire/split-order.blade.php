<div class="grid grid-cols-[20em_20em_1fr] overflow-auto h-full">

    <div class="flex flex-col min-h-full border-r-2 border-gray-400">
        <div class="flex justify-between px-4 py-2">
            <div class="">Order - {{ $order->id }}</div>
            <div class="flex gap-2">
                @foreach ($order->tables as $table)
                    <button
                        @disabled($table->is($this->table))
                        class="px-2 border rounded-md cursor-pointer hover:bg-white disabled:bg-green-300 disabled:text-white disabled:pointer-events-none"
                        wire:click="$set('table_id', {{ $table->id }})"
                    >{{ $table->name }}</button>
                @endforeach
            </div>
        </div>
        @php
            $total = 0;
        @endphp
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

                    $oqty = $temp_items[$id]['qty'] ?? 0;
                    $qty = $qty - $oqty;

                    $total += $subtotal = $price * $qty;
                @endphp
                @if ($qty)
                    <div
                        class="flex flex-col gap-2 px-4 py-3 overflow-hidden transition-shadow bg-white border-b border-gray-200">
                        <div class="flex justify-between leading-7 truncate">
                            <div class="leading-7 truncate">{{ $name }}</div>

                            <div class="flex gap-1">
                                <button
                                    {{-- wire:loading.attr="disabled" --}}
                                    @disabled(!$qty)
                                    class="px-5 border border-gray-300 rounded-md hover:bg-gray-100 disabled:bg-gray-100"
                                    wire:click='toRight({{ $id }},{{ $itemId }})'
                                >
                                    &rightarrow;
                                </button>
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
                @endif
            @endforeach
        </div>

        <div class="flex justify-between gap-5 p-4 text-lg font-bold bg-gray-200 tabular-nums">
            @if ($order->table_orders->count() > 1)
                Subtotal
            @else
                Total
            @endif
            <span>{{ number_format($total, 2) }}</span>
        </div>

        @if ($order->table_orders->count() > 1)
            <div class="flex justify-between gap-5 p-4 mt-1 text-xl font-bold bg-gray-200 tabular-nums">
                Total
                <span>{{ number_format($order->total() - $this->total, 2) }}</span>
            </div>
        @endif
    </div>

    <div class="flex flex-col min-h-full border-r-2 border-gray-400">
        <div class="flex justify-between px-4 py-2">
            <div class="">Order (Temporary)</div>
        </div>
        <div class="flex-1 overflow-auto">
            @foreach ($temp_items as $id => $order_item)
                @php
                    [
                        'item' => [
                            'id' => $itemId,
                            'name' => $name,
                            'price' => $price,
                        ],
                        'qty' => $qty,
                    ] = $order_item;
                    $subtotal = $price * $qty;
                @endphp
                <div
                    class="flex flex-col gap-2 px-4 py-3 overflow-hidden transition-shadow bg-white border-b border-gray-200">
                    <div class="flex justify-between leading-7 truncate">
                        <button
                            {{-- wire:loading.attr="disabled" --}}
                            @disabled($this->table->name != $order_item['table']['name'])
                            class="px-5 border border-gray-300 rounded-md hover:bg-gray-100 disabled:bg-gray-100"
                            wire:click='toLeft({{ $id }},{{ $itemId }})'
                        >
                            {{ $order_item['table']['name'] }} &leftarrow;
                        </button>
                        <div class="leading-7 truncate">{{ $name }}</div>
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

        <div class="flex justify-between gap-5 p-4 mt-1 text-xl font-bold bg-gray-200 tabular-nums">
            Total
            <span>{{ number_format($this->total, 2) }}</span>
        </div>
    </div>
    <div class="flex gap-5 p-4">
        {{-- <a
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
        </a> --}}
        <button
            class="px-4 py-1 mt-auto border border-red-400 rounded-md hover:text-white hover:bg-red-400 disabled:border-gray-400 disabled:bg-gray-100 disabled:text-gray-400"
            @disabled(!$this->total)
            wire:click='confirmSplit'
        >
            Split and Checkout
        </button>
    </div>
</div>
