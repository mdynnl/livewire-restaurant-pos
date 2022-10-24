<div class="flex flex-col flex-1 h-full overflow-y-auto">
    <div class="p-4">
        <x-search class="sticky top-0" />
    </div>
    <div class="flex-1 px-4 pb-4 overflow-y-auto">
        <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] content-start gap-4">
            @forelse ($items as $item)
                <x-item
                    :$item
                    wire:click="$emitUp('clickItem', {{ $item->id }});"
                />
            @empty
                <div class="px-2">No results</div>
            @endforelse
        </div>
    </div>

    <div class="mt-4">{{ $items->onEachSide(1)->links() }}</div>
</div>
