<div class="flex flex-col flex-1 overflow-auto">

    <div class="relative">
        <div
            @class([
                $table->get_occupied_percent() > 1 ? 'bg-red-600' : 'bg-green-600',
                'absolute top-0 bottom-0 left-0 opacity-40',
            ])
            style="width: min(100%, {{ $table->get_occupied_percent() * 100 }}%)"
        >
        </div>
        <div class="relative flex items-center justify-between gap-1 px-6 py-3 ">
            <div class="leading-7 truncate">{{ $table->name }}</div>
            <div class="text-xs text-gray-600">
                {{ $table->get_occupied_seats() }}/{{ $table->seats }}
                {{ Str::plural('seat', $table->seats) }}
            </div>
            <div class="text-xs text-gray-600">
                @if ($count = count($table->active_orders))
                    {{ $count }}
                    {{ Str::plural('order', $count) }}
                @endif
            </div>
            <button
                class="px-4 py-2 text-xs bg-gray-200 rounded-md hover:bg-white"
                wire:click="newOrder"
                wire:loading.attr="disabled"
            >
                New Order
            </button>
        </div>
    </div>

    <div class="flex-1 overflow-auto">
        <div class="m-10 grid grid-cols-[repeat(auto-fill,minmax(400px,1fr))] content-start gap-4">
            @forelse ($active_orders as $order)
                <a
                    class="flex items-center justify-between gap-3 px-6 py-4 overflow-hidden transition-shadow bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer tables-center outline-offset-4 outline-2 hover:shadow-md"
                    href="{{ route('order', ['order' => $order->id, 'table' => $table->id]) }}"
                    title="{{ $order->id }}"
                >
                    <div class="">Order - {{ $order->id }}</div>
                    <div class="flex gap-2">
                        @foreach ($order->tables as $table)
                            <div @class([
                                'px-2 border rounded-md',
                                $table->is($this->table) ? 'bg-green-300 text-white' : '',
                            ])>{{ $table->name }}</div>
                        @endforeach
                    </div>
                    <x-delete-btn
                        wire:click.prevent.stop="deleteOrder({{ $order->id }})"
                        wire:loading.attr="disabled"
                    />
                </a>
            @empty
            @endforelse
        </div>
    </div>

</div>
