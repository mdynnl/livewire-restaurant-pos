<div class="overflow-auto">

    <div class="m-10 grid grid-cols-[repeat(auto-fill,minmax(200px,1fr))] content-start gap-10">
        @foreach ($all as $table)
            <a
                class="relative flex flex-col gap-1 px-6 py-4 overflow-hidden transition-shadow bg-white border border-gray-300 rounded-md shadow-sm cursor-pointer outline-2 outline-offset-4 hover:shadow-md"
                href="{{ route('table', $table->id) }}"
                title="{{ $table->name }}"
            >
                <div
                    @class([
                        $table->get_occupied_percent() > 1 ? 'bg-red-600' : 'bg-green-600',
                        'absolute top-0 bottom-0 left-0 pointer-events-none opacity-40',
                    ])
                    style="width: min(100%, {{ $table->get_occupied_percent() * 100 }}%)"
                >
                </div>
                <div class="leading-7 truncate">{{ $table->name }}</div>
                <div class="flex justify-between w-full">
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
                </div>
            </a>
        @endforeach
    </div>

</div>
