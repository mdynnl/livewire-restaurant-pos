<div>
    <div
        class="flex items-center justify-between gap-2 px-4 py-2 overflow-hidden transition-shadow bg-white border border-gray-300 shadow-sm outline-offset-4 outline-2 hover:shadow-md"
        href="{{ route('order', $order->id) }}"
        title="{{ $order->id }}"
        x-id="[order]"
    >
        <div class="">Order - {{ $order->id }}</div>
        <div class="flex gap-2">
            @foreach ($order->tables as $table)
                <div class="px-2 border rounded-md">{{ $table->name }}</div>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col gap-4 px-6 ">
        <h2 class="mt-5 text-xl leading-8">Un-merge tables</h2>
        <button
            @disabled(empty($tables_selected) || !collect($tables_selected)->some(true))
            class="px-4 py-1 mr-auto text-white bg-red-500 border border-red-300 rounded-md hover:bg-red-600 disabled:bg-red-300 disabled:hover:bg-red-300"
            wire:click='unmerge'
            wire:loading.attr='disabled'
        >
            Un-merge
        </button>
        <div class="flex gap-4">
            @forelse ($order->table_orders->slice(1) as $table_order)
                <label
                    class="flex items-center justify-between gap-2 px-4 py-2 overflow-hidden transition-shadow bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer outline-offset-4 outline-2 hover:shadow-md"
                    title="{{ $table_order->id }}"
                >
                    <input
                        type="checkbox"
                        wire:model='tables_selected.{{ $table_order->id }}'
                    />
                    <div class="">Table - {{ $table_order->table->name }}</div>
                </label>
            @empty
                No tables to un-merge
            @endforelse
        </div>
    </div>

    <div class="flex flex-col gap-4 px-6 border-t-4 border-t-gray-600 mt-7">
        <h2 class="mt-5 text-xl leading-8">Merge orders</h2>
        <button
            @disabled(empty($selected) || !collect($selected)->some(true))
            class="px-4 py-1 mr-auto text-white bg-red-500 border border-red-300 rounded-md hover:bg-red-600 disabled:bg-red-300 disabled:hover:bg-red-300"
            wire:click='merge'
            wire:loading.attr='disabled'
        >
            Merge
        </button>
        <div class="flex gap-4">
            @forelse ($all_orders as $order)
                <label
                    class="flex items-center justify-between gap-2 px-4 py-2 overflow-hidden transition-shadow bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer outline-offset-4 outline-2 hover:shadow-md"
                    title="{{ $order->id }}"
                >
                    <input
                        type="checkbox"
                        wire:model='selected.{{ $order->id }}'
                    />
                    <div class="">Order - {{ $order->id }}</div>
                    <div class="flex gap-2">
                        @foreach ($order->tables as $table)
                            <div class="px-2 border rounded-md">{{ $table->name }}</div>
                        @endforeach
                    </div>
                </label>
            @empty
                No orders to merge
            @endforelse
        </div>
    </div>
</div>
