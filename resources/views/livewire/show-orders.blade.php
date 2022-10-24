<div class="flex flex-col overflow-auto">
    <div class="flex gap-4 mx-4 mt-4">
        @foreach ($order_status_cases as $case)
            <button
                @disabled($case == $status->value)
                class="px-5 py-2 bg-white border rounded-lg hover:text-white hover:bg-blue-400 disabled:bg-blue-500 disabled:text-white"
                wire:click="setStatus('{{ $case }}')"
            >{{ ucfirst($case) }}</button>
        @endforeach
    </div>
    <div class="sticky top-0 p-4 bg-gray-100">
        <x-search />
    </div>

    <div class="grid content-start flex-1 gap-4 px-4 mb-4">
        @if (!$orders->count())
            No results
        @endif
        @foreach ($orders as $order)
            <a
                class="flex items-center justify-between gap-3 px-6 py-4 overflow-hidden transition-shadow bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer tables-center outline-offset-4 outline-2 hover:shadow-md"
                href="{{ $order->status->value === 'paid' ? route('checkout', $order) : route('order', $order) }}"
                title="{{ $order->id }}"
            >
                <div class="">Order - {{ $order->id }}</div>
                {{-- <div class="text-xs">
                    {{ $tables = $order->tables()->count() }}
                    {{ Str::plural('table', $tables) }}
                </div> --}}
                <div class="flex gap-2">
                    @foreach ($order->tables as $table)
                        <div class="px-2 border rounded-md">{{ $table->name }}</div>
                    @endforeach
                </div>
                <div class="ml-auto">{{ number_format($order->total(), 2) }}</div>
                @if ($order->status->value == 'paid')
                    Paid
                @else
                    <x-delete-btn
                        wire:click.prevent.stop="deleteOrder({{ $order->id }})"
                        wire:loading.attr="disabled"
                    />
                @endif

            </a>
        @endforeach
    </div>
    {{-- <div class="px-4 pb-4">{{ $orders->onEachSide(1)->links() }}</div> --}}
</div>
